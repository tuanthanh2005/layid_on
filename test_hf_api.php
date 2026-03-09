<?php
// Test HF Router mới (router.huggingface.co)
$env = file_get_contents(__DIR__ . '/.env');
preg_match('/HUGGINGFACE_API_KEY=(.+)/', $env, $m);
$hfKey = trim($m[1] ?? '');
echo "Key: " . substr($hfKey, 0, 15) . "...\n\n";

// Tạo ảnh test
$img   = imagecreatetruecolor(200, 200);
$bg    = imagecolorallocate($img, 80, 120, 200);
imagefill($img, 0, 0, $bg);
$white = imagecolorallocate($img, 255, 255, 255);
imagestring($img, 5, 20, 90, 'GEMINI LOGO', $white);
$tmpPath = sys_get_temp_dir() . '/test_gemini.jpg';
imagejpeg($img, $tmpPath, 90);
imagedestroy($img);

$imageContent = file_get_contents($tmpPath);
echo "Image: " . strlen($imageContent) . " bytes\n\n";

// HF Router mới - dùng inpainting model
// FLUX.1-inpaint - model xóa vật thể mạnh nhất hiện tại
$endpoints = [
    'stabilityai/stable-diffusion-2-inpainting' => "https://router.huggingface.co/hf-inference/models/stabilityai/stable-diffusion-2-inpainting",
    'Sanster/PowerPaint-V2' => "https://router.huggingface.co/hf-inference/models/Sanster/PowerPaint-V2",
];

// Test auth đơn giản
$ch = curl_init('https://router.huggingface.co/hf-inference/models/black-forest-labs/FLUX.1-schnell');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_HTTPHEADER     => [
        'Authorization: Bearer ' . $hfKey,
        'Content-Type: application/json',
    ],
    CURLOPT_POSTFIELDS     => json_encode(['inputs' => 'a blue sky']),
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_SSL_VERIFYPEER => false,
]);
$res  = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "FLUX.1 test: HTTP $code\n";
if ($code == 200) {
    echo "SUCCESS! Image response received (" . strlen($res) . " bytes)\n";
} else {
    $data = json_decode($res, true);
    echo "Response: " . ($data['error'] ?? substr($res, 0, 300)) . "\n";
}

echo "\n--- Testing image-to-image / inpainting ---\n";
// Test Hugging Face image classification model (đơn giản để check auth)
$ch2 = curl_init('https://router.huggingface.co/hf-inference/models/Salesforce/blip-image-captioning-base');
curl_setopt_array($ch2, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_HTTPHEADER     => [
        'Authorization: Bearer ' . $hfKey,
        'Content-Type: application/octet-stream',
    ],
    CURLOPT_POSTFIELDS     => $imageContent,
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_SSL_VERIFYPEER => false,
]);
$res2  = curl_exec($ch2);
$code2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
curl_close($ch2);

echo "Image captioning test: HTTP $code2\n";
echo "Response: " . substr($res2, 0, 200) . "\n";
