<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 180000; $i++) {
            $data[] = [
                'ticket_id' => rand(1, 60000),
                'created_at' => now()->subDays(rand(0, 60)),
                'updated_at' => now(),
            ];

            if ($i % 1000 === 0) {
                DB::table('ticket_logs')->insert($data);
                $data = [];
            }
        }
    }
}
