<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::statement('DELETE FROM status');
        DB::statement('ALTER TABLE status AUTO_INCREMENT = 1');
        Schema::enableForeignKeyConstraints();
         DB::table('status')->insert([
            'model_id' => 1,
            'name' => 'Delivery',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('status')->insert([
            'model_id' => 1,
            'name' => 'Order Placed',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('status')->insert([
            'model_id' => 1,
            'name' => 'shipped',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('status')->insert([
            'model_id' => 1,
            'name' => 'IN Transit',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('status')->insert([
            'model_id' => 1,
            'name' => 'out for delivery',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('status')->insert([
            'model_id' => 1,
            'name' => 'Delivered',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('status')->insert([
            'model_id' => 1,
            'name' => 'Order Cancelled',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('status')->insert([
            'model_id' => 1,
            'name' => 'Return initiated',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('status')->insert([
            'model_id' => 1,
            'name' => 'Return picked up',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('status')->insert([
            'model_id' => 1,
            'name' => 'Refund processed',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('status')->insert([
            'model_id' => 1,
            'name' => 'Return completed',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
    }
};
