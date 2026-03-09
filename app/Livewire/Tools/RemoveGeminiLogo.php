<?php

namespace App\Livewire\Tools;

use Livewire\Component;
use Livewire\WithFileUploads;

class RemoveGeminiLogo extends Component
{
    use WithFileUploads;

    public $image;
    public $processed         = false;
    public $processing        = false;
    public $processedImageUrl = null;  // chỉ lưu URL ngắn, KHÔNG phải base64
    public $tempFilePath      = null;  // đường dẫn file temp để dọn khi reset
    public $errorMessage      = null;

    // --- Algorithm constants (mirrored from blendModes.js) ---
    const ALPHA_NOISE_FLOOR = 3 / 255.0;  // Remove low-level quantization noise
    const ALPHA_THRESHOLD   = 0.002;       // Ignore very small alpha values
    const MAX_ALPHA         = 0.99;        // Avoid division by near-zero
    const LOGO_VALUE        = 255.0;       // White watermark

    public function updatedImage()
    {
        $this->validate(['image' => 'image|max:10240']);
        $this->processed      = false;
        $this->processedImageUrl = null;
        $this->errorMessage   = null;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Load & cache alpha map from the pre-captured background PNG
    // ─────────────────────────────────────────────────────────────────────────
    private function loadAlphaMap(int $size): array
    {
        $bgPath = public_path("assets/watermark/bg_{$size}.png");

        if (!file_exists($bgPath)) {
            throw new \RuntimeException("Alpha map file not found: bg_{$size}.png");
        }

        $bg = imagecreatefrompng($bgPath);
        if (!$bg) {
            throw new \RuntimeException("Cannot read alpha map: bg_{$size}.png");
        }

        $w = imagesx($bg);
        $h = imagesy($bg);

        $map = [];
        for ($row = 0; $row < $h; $row++) {
            for ($col = 0; $col < $w; $col++) {
                $rgb = imagecolorat($bg, $col, $row);
                $r   = ($rgb >> 16) & 0xFF;
                $g   = ($rgb >> 8)  & 0xFF;
                $b   =  $rgb        & 0xFF;

                // Take max of RGB channels, normalize to [0,1]
                $map[$row][$col] = max($r, $g, $b) / 255.0;
            }
        }

        imagedestroy($bg);
        return $map;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Detect watermark config from image dimensions
    // ─────────────────────────────────────────────────────────────────────────
    private function detectConfig(int $width, int $height): array
    {
        if ($width > 1024 && $height > 1024) {
            return ['logo_size' => 96, 'margin' => 64];
        }
        return ['logo_size' => 48, 'margin' => 32];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Main watermark removal - pure PHP reverse alpha blending
    // ─────────────────────────────────────────────────────────────────────────
    public function process()
    {
        if (!$this->image) return;

        $this->processing   = true;
        $this->errorMessage = null;

        try {
            $realPath = $this->image->getRealPath();
            $mimeType = $this->image->getMimeType() ?? 'image/png';

            // ── 1. Load source image into GD resource ──────────────────────
            $img = match (true) {
                str_contains($mimeType, 'png')  => imagecreatefrompng($realPath),
                str_contains($mimeType, 'webp') => imagecreatefromwebp($realPath),
                str_contains($mimeType, 'gif')  => imagecreatefromgif($realPath),
                default                         => imagecreatefromjpeg($realPath),
            };

            if (!$img) {
                throw new \RuntimeException('Không thể đọc file ảnh. Vui lòng thử lại với file hợp lệ.');
            }

            $width  = imagesx($img);
            $height = imagesy($img);

            // ── 2. Detect watermark configuration ─────────────────────────
            $config   = $this->detectConfig($width, $height);
            $logoSize = $config['logo_size'];
            $margin   = $config['margin'];

            // Watermark is at bottom-right corner
            $wX = $width  - $margin - $logoSize;
            $wY = $height - $margin - $logoSize;

            if ($wX < 0 || $wY < 0) {
                // Image too small to have watermark – return as-is
                $this->saveToTempFile($img, $mimeType);
                imagedestroy($img);
                $this->processed  = true;
                $this->processing = false;
                return;
            }

            // ── 3. Load alpha map ──────────────────────────────────────────
            $alphaMap = $this->loadAlphaMap($logoSize);

            // ── 4. Apply reverse alpha blending ───────────────────────────
            // Convert to true-color to allow direct pixel manipulation
            if (!imageistruecolor($img)) {
                imagepalettetotruecolor($img);
            }
            imagealphablending($img, false);
            imagesavealpha($img, true);

            $alphaNoiseFloor = self::ALPHA_NOISE_FLOOR;
            $alphaThreshold  = self::ALPHA_THRESHOLD;
            $maxAlpha        = self::MAX_ALPHA;
            $logoValue       = self::LOGO_VALUE;

            for ($row = 0; $row < $logoSize; $row++) {
                for ($col = 0; $col < $logoSize; $col++) {
                    $rawAlpha   = $alphaMap[$row][$col];
                    $signalAlpha = max(0.0, $rawAlpha - $alphaNoiseFloor);

                    if ($signalAlpha < $alphaThreshold) {
                        continue; // skip near-transparent pixels
                    }

                    $alpha        = min($rawAlpha, $maxAlpha);
                    $oneMinusAlpha = 1.0 - $alpha;

                    $px  = imagecolorat($img, $wX + $col, $wY + $row);
                    $r   = ($px >> 16) & 0xFF;
                    $g   = ($px >> 8)  & 0xFF;
                    $b   =  $px        & 0xFF;
                    $a   = ($px >> 24) & 0x7F; // GD uses 0=opaque, 127=transparent

                    // Apply reverse alpha blending to each channel
                    $rNew = (int) round(($r - $alpha * $logoValue) / $oneMinusAlpha);
                    $gNew = (int) round(($g - $alpha * $logoValue) / $oneMinusAlpha);
                    $bNew = (int) round(($b - $alpha * $logoValue) / $oneMinusAlpha);

                    // Clamp to [0, 255]
                    $rNew = max(0, min(255, $rNew));
                    $gNew = max(0, min(255, $gNew));
                    $bNew = max(0, min(255, $bNew));

                    $newColor = imagecolorallocatealpha($img, $rNew, $gNew, $bNew, $a);
                    imagesetpixel($img, $wX + $col, $wY + $row, $newColor);
                }
            }

            // ── 5. Ghi ra file temp, lưu URL ngắn ────────────────────────
            $this->saveToTempFile($img, $mimeType);
            imagedestroy($img);

            $this->processed = true;

        } catch (\Throwable $e) {
            $this->errorMessage = 'Lỗi xử lý: ' . $e->getMessage();
        }

        $this->processing = false;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Ghi GD image ra file temp trong public/temp/watermark/
    // Chỉ lưu URL ngắn vào Livewire state — tránh PayloadTooLarge
    // ─────────────────────────────────────────────────────────────────────────
    private function saveToTempFile($img, string $mimeType): void
    {
        $dir = public_path('temp/watermark');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $uid = uniqid('gwm_', true);

        if (str_contains($mimeType, 'png')) {
            $filename = "{$uid}.png";
            imagepng($img, $dir . '/' . $filename, 6);
        } elseif (str_contains($mimeType, 'webp')) {
            $filename = "{$uid}.webp";
            imagewebp($img, $dir . '/' . $filename, 90);
        } else {
            $filename = "{$uid}.jpg";
            imagejpeg($img, $dir . '/' . $filename, 92);
        }

        // Xoá file temp cũ (nếu có) trước khi gán mới
        $this->deleteTempFile();

        $this->tempFilePath      = $dir . '/' . $filename;   // để dọn sau
        $this->processedImageUrl = asset("temp/watermark/{$filename}"); // URL ngắn
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Xoá file temp khỏi disk
    // ─────────────────────────────────────────────────────────────────────────
    private function deleteTempFile(): void
    {
        if ($this->tempFilePath && file_exists($this->tempFilePath)) {
            @unlink($this->tempFilePath);
        }
        $this->tempFilePath = null;
    }

    public function resetTool()
    {
        $this->deleteTempFile();  // xoá file ảnh khỏi disk trước
        $this->reset(['image', 'processed', 'processing', 'processedImageUrl', 'tempFilePath', 'errorMessage']);
    }

    public function render()
    {
        return view('livewire.tools.remove-gemini-logo')
            ->layout('layouts.app');
    }
}
