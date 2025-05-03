<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            ['model_id' => null, 'name' => 'Delivery'],
            ['model_id' => null, 'name' => 'On the Way'],
            ['model_id' => null, 'name' => 'Cancel'],
            ['model_id' => null, 'name' => 'Returned'],
        ];

        DB::table('status')->insert($statuses);
    }
}
