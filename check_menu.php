<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$menu = \App\Models\Menu::where('name', 'Học Ngôn Ngữ Miễn Phí')->first();
if ($menu) {
    echo "Found menu: " . $menu->name . " with URL: " . $menu->url . "\n";
    if ($menu->url !== '/ngon-ngu-mien-phi') {
        $menu->url = '/ngon-ngu-mien-phi';
        $menu->save();
        echo "Updated URL to /ngon-ngu-mien-phi\n";
    }
} else {
    echo "Menu 'Học Ngôn Ngữ Miễn Phí' not found.\n";
}
