<?php
$spaces = [
    'huzpsb/watermark-remover'    => 'https://huzpsb-watermark-remover.hf.space/info',
    'ucalyptus/WatermarkRemover'  => 'https://ucalyptus-watermarkremover.hf.space/info',
    'NeuralFalcon/Meta-Watermark-Remover' => 'https://neuralfalcon-meta-watermark-remover.hf.space/info',
];

foreach ($spaces as $name => $url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 8);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $body = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err  = curl_error($ch);
    curl_close($ch);
    echo "$name => HTTP $code | " . ($err ?: substr($body, 0, 80)) . "\n";
}
