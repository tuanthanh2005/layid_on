<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$menu = \App\Models\Menu::where('name', 'Học IT Miễn Phí')->first();
if ($menu) {
    echo "Found menu: " . $menu->name . " with URL: " . $menu->url . "\n";
    if ($menu->url !== '/hoc-it') {
        $menu->url = '/hoc-it';
        $menu->save();
        echo "Updated URL to /hoc-it\n";
    }
} else {
    echo "Menu 'Học IT Miễn Phí' not found.\n";
}
