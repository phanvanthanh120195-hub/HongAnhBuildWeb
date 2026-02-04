<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = Illuminate\Support\Facades\DB::select("SHOW TABLES");
foreach ($tables as $table) {
    foreach ($table as $key => $value) {
        if ($value === 'categories' || $value === 'product_categories') {
            echo "Table Found: " . $value . "\n";
        }
    }
}
