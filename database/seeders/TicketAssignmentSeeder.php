<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($ticketId = 1; $ticketId <= 60000; $ticketId++) {

            $totalTechnician = rand(1, 3);

            for ($i = 0; $i < $totalTechnician; $i++) {
                $data[] = [
                    'ticket_id' => $ticketId,
                    'technician_id' => rand(1, 2000),
                ];
            }

            if ($ticketId % 500 === 0) {
                DB::table('ticket_assignments')->insert($data);
                $data = [];
            }
        }
    }
}
