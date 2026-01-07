<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class WorkOrderProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['open', 'progress', 'done'];
        $data = [];

        for ($i = 1; $i <= 30000; $i++) {
            $data[] = [
                'work_order_id' => rand(1, 10000),
                'status' => Arr::random($statuses),
                'created_at' => now()->subDays(rand(0, 60)),
                'updated_at' => now(),
            ];

            if ($i % 500 === 0) {
                DB::table('work_order_progresses')->insert($data);
                $data = [];
            }
        }
    }
}
