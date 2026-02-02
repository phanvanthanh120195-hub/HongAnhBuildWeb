<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Step 1: Drop FK if exists
try {
    DB::statement("ALTER TABLE reviews DROP FOREIGN KEY reviews_user_id_foreign");
    echo "Step 1: FK dropped\n";
} catch (\Exception $e) {
    echo "Step 1: FK not found (OK)\n";
}

// Step 2: Drop user_id column
try {
    DB::statement("ALTER TABLE reviews DROP COLUMN user_id");
    echo "Step 2: user_id dropped\n";
} catch (\Exception $e) {
    echo "Step 2 Error: " . $e->getMessage() . "\n";
}

// Step 3: Add customer_id column
try {
    DB::statement("ALTER TABLE reviews ADD COLUMN customer_id BIGINT UNSIGNED NULL AFTER course_id");
    echo "Step 3: customer_id added\n";
} catch (\Exception $e) {
    echo "Step 3 Error: " . $e->getMessage() . "\n";
}

// Step 4: Add FK constraint
try {
    DB::statement("ALTER TABLE reviews ADD CONSTRAINT reviews_customer_id_foreign FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL");
    echo "Step 4: FK added\n";
} catch (\Exception $e) {
    echo "Step 4 Error: " . $e->getMessage() . "\n";
}

// Step 5: Mark migration as done
try {
    $maxBatch = DB::table('migrations')->max('batch');
    DB::table('migrations')->insert([
        'migration' => '2026_01_31_082918_change_user_id_to_customer_id_in_reviews_table',
        'batch' => $maxBatch + 1
    ]);
    echo "Step 5: Migration marked as done\n";
} catch (\Exception $e) {
    echo "Step 5 Error: " . $e->getMessage() . "\n";
}

echo "\n=== DONE ===\n";
