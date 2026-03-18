<?php

namespace App\Livewire\Tools;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class RemoveBg extends Component
{
    use WithFileUploads;

    public $image;
    public $previewUrl  = '';
    public $inputFile   = '';   // tên file input trong public/temp/
    public $resultUrl   = '';
    public $loading     = false;
    public $error       = '';

    /**
     * Tự động chạy khi user chọn file.
     * Dùng getRealPath() để lấy path thật của Livewire tmp file
     * rồi copy thẳng vào public/temp/ bằng PHP native copy().
     */
    public function updatedImage()
    {
        $this->error      = '';
        $this->resultUrl  = '';
        $this->previewUrl = '';
        $this->inputFile  = '';

        if (!$this->image) {
            return;
        }

        try {
            $this->validate([
                'image' => 'image|mimes:jpg,jpeg,png,webp,gif,bmp|max:10240',
            ]);

            $ext      = $this->image->getClientOriginalExtension() ?: 'jpg';
            $fileName = 'input_' . Str::random(12) . '.' . $ext;
            $destDir  = public_path('temp');

            if (!is_dir($destDir)) {
                mkdir($destDir, 0755, true);
            }

            $destPath = $destDir . DIRECTORY_SEPARATOR . $fileName;

            // Lấy path thật của file Livewire tmp rồi copy bằng PHP native
            $realPath = $this->image->getRealPath();

            if (!$realPath || !file_exists($realPath)) {
                throw new \Exception('Không đọc được file tạm, vui lòng thử lại.');
            }

            if (!copy($realPath, $destPath)) {
                throw new \Exception('Không thể copy file vào public/temp/.');
            }

            $this->inputFile  = $fileName;
            $this->previewUrl = asset('temp/' . $fileName);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->error = 'File không hợp lệ. Chỉ chấp nhận ảnh JPG, PNG, WEBP (tối đa 10MB).';
            $this->image = null;
        } catch (\Exception $e) {
            $this->error = 'Không thể tải ảnh lên: ' . $e->getMessage();
            $this->image = null;
        }
    }

    public function process()
    {
        if (!$this->inputFile) {
            $this->error = 'Vui lòng chọn ảnh trước.';
            return;
        }

        $this->loading   = true;
        $this->error     = '';
        $this->resultUrl = '';

        try {
            $fullInputPath = public_path('temp' . DIRECTORY_SEPARATOR . $this->inputFile);

            if (!file_exists($fullInputPath)) {
                throw new \Exception('File ảnh không còn tồn tại, vui lòng tải lại ảnh.');
            }

            $outputName     = 'result_' . Str::random(8) . '.png';
            $fullOutputPath = public_path('temp' . DIRECTORY_SEPARATOR . $outputName);

            // Chạy Python script rembg
            $pythonPath = 'python';
            $scriptPath = app_path('Livewire' . DIRECTORY_SEPARATOR . 'Tools' . DIRECTORY_SEPARATOR . 'remove_bg.py');

            $command = "$pythonPath \"$scriptPath\" \"$fullInputPath\" \"$fullOutputPath\" 2>&1";
            exec($command, $output, $returnCode);

            if ($returnCode !== 0) {
                throw new \Exception('Lỗi xử lý AI: ' . implode(' | ', $output));
            }

            if (!file_exists($fullOutputPath)) {
                throw new \Exception('AI xử lý xong nhưng không tạo được file kết quả.');
            }

            $this->resultUrl = asset('temp/' . $outputName);

        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.tools.remove-bg');
    }
}
