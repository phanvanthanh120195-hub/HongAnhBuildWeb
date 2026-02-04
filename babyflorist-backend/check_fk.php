<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$keys = Illuminate\Support\Facades\DB::select("
    SELECT CONSTRAINT_NAME 
    FROM information_schema.KEY_COLUMN_USAGE 
    WHERE TABLE_NAME = 'products' 
    AND TABLE_SCHEMA = '" . env('DB_DATABASE') . "' 
    AND REFERENCED_TABLE_NAME IS NOT NULL
");

foreach ($keys as $key) {
    echo "FK Found: " . $key->CONSTRAINT_NAME . "\n";
}
