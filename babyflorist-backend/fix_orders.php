<?php
/**
 * Direct database fix script for orders table
 * Run with: php fix_orders.php
 */

// Bootstrap Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== Fixing orders table structure ===\n\n";

try {
    // Check current columns
    $columns = Schema::getColumnListing('orders');
    echo "Current columns: " . implode(', ', $columns) . "\n\n";

    // Check if customer_id exists
    if (!in_array('customer_id', $columns)) {
        echo "Adding customer_id column...\n";
        
        // Drop user_id foreign key if exists
        try {
            DB::statement('ALTER TABLE orders DROP FOREIGN KEY orders_user_id_foreign');
            echo "  - Dropped orders_user_id_foreign FK\n";
        } catch (\Exception $e) {
            echo "  - No user_id FK to drop (or already dropped)\n";
        }

        // Check if user_id exists and rename, otherwise add customer_id
        if (in_array('user_id', $columns)) {
            DB::statement('ALTER TABLE orders CHANGE COLUMN user_id customer_id BIGINT UNSIGNED NULL');
            echo "  - Renamed user_id to customer_id\n";
        } else {
            DB::statement('ALTER TABLE orders ADD COLUMN customer_id BIGINT UNSIGNED NULL AFTER order_number');
            echo "  - Added customer_id column\n";
        }

        // Add foreign key to customers
        try {
            DB::statement('ALTER TABLE orders ADD CONSTRAINT orders_customer_id_foreign FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL');
            echo "  - Added FK to customers table\n";
        } catch (\Exception $e) {
            echo "  - Warning: Could not add FK to customers: " . $e->getMessage() . "\n";
        }
    } else {
        echo "customer_id column already exists.\n";
    }

    // Check if order_type exists
    if (!in_array('order_type', $columns)) {
        echo "\nAdding order_type column...\n";
        DB::statement("ALTER TABLE orders ADD COLUMN order_type ENUM('product', 'course') NOT NULL DEFAULT 'product' AFTER order_number");
        echo "  - Added order_type column\n";
    } else {
        echo "order_type column already exists.\n";
    }

    // Final check
    $newColumns = Schema::getColumnListing('orders');
    echo "\n=== Updated columns: " . implode(', ', $newColumns) . " ===\n";
    
    echo "\n✅ Orders table fix completed successfully!\n";

} catch (\Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
