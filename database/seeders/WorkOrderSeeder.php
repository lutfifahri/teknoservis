<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 10000; $i++) {
            $data[] = [
                'work_code' => 'WO-' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'region_id' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($i % 500 === 0) {
                DB::table('work_orders')->insert($data);
                $data = [];
            }
        }
    }
}
