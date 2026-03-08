<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;

$columnsUsers = Schema::getColumnListing('users');
echo "users: " . implode(',', $columnsUsers) . "\n";

$hasOrders = Schema::hasTable('orders');
echo "orders exists: " . ($hasOrders ? 'yes' : 'no') . "\n";
if ($hasOrders) {
    echo "orders: " . implode(',', Schema::getColumnListing('orders')) . "\n";
}
