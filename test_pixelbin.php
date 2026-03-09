<?php
$apiKey = '6c94d320-95a5-4359-9d78-bdbf8b9b65e1';
$testImagePath = __DIR__ . '/public/favicon.ico';

// Nếu favicon không phải ảnh thật thì tải ảnh test
if (!file_exists($testImagePath) || filesize($testImagePath) < 100) {
    $testImageContent = @file_get_contents('https://via.placeholder.com/200.jpg');
    if (!$testImageContent) {
        // Tạo 1 ảnh JPEG đơn giản bằng GD
        $img = imagecreatetruecolor(100, 100);
        $color = imagecolorallocate($img, 100, 150, 200);
        imagefill($img, 0, 0, $color);
        $testImagePath = sys_get_temp_dir() . '/test_pxbin.jpg';
        imagejpeg($img, $testImagePath, 90);
        imagedestroy($img);
    } else {
        $testImagePath = sys_get_temp_dir() . '/test_pxbin.jpg';
        file_put_contents($testImagePath, $testImageContent);
    }
}

echo "Image path: $testImagePath (" . filesize($testImagePath) . " bytes)\n\n";

function testCall($url, $headers, $imagePath, $imageField) {
    echo "POST $url\n";
    echo "Header: " . implode(', ', $headers) . "\n";
    echo "Field: $imageField\n";
    
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_POSTFIELDS     => [
            $imageField => new CURLFile($imagePath, 'image/jpeg', 'test.jpg'),
        ],
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    
    $response  = curl_exec($ch);
    $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    echo "HTTP: $httpCode | Error: " . ($curlError ?: 'none') . "\n";
    echo "Body: " . substr($response, 0, 500) . "\n";
    echo str_repeat('=', 60) . "\n\n";
}

// Test với Bearer Token (chuẩn JWT)
testCall(
    'https://api.pixelbin.io/service/platform/assets/v2.0/playground/plugins/Erase/bg_removal',
    ['Authorization: Bearer ' . $apiKey, 'Accept: application/json'],
    $testImagePath, 'image'
);

// Test watermark endpoint với Bearer
testCall(
    'https://api.pixelbin.io/service/platform/watermark_remover/v1.0/remove',
    ['Authorization: Bearer ' . $apiKey, 'Accept: application/json'],
    $testImagePath, 'image'
);

// Test watermark endpoint cách khác   
testCall(
    'https://api.pixelbin.io/v1/watermark_remover/remove',
    ['Authorization: Bearer ' . $apiKey, 'Accept: application/json'],
    $testImagePath, 'image'
);

// Test với x-api-token
testCall(
    'https://api.pixelbin.io/v1/watermark_remover/remove',
    ['x-api-token: ' . $apiKey, 'Accept: application/json'],
    $testImagePath, 'image'
);

echo "DONE\n";
