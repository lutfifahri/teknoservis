<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class TicketAssignModal extends Component
{
    public $show = false;
    public $workOrderId;

    public $ticket_id;
    public $technician_id;

    protected $listeners = ['openAssignModal'];

    public function openAssignModal($workOrderId)
    {
        $this->workOrderId = $workOrderId;
        $this->show = true;
    }

    public function assign()
    {
        DB::table('ticket_assignments')->insert([
            'ticket_id' => $this->ticket_id,
            'technician_id' => $this->technician_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // refresh table utama
        $this->emit('refreshTable');

        // reset & close modal
        $this->reset(['ticket_id', 'technician_id', 'show']);
    }

    public function render()
    {
        return view('livewire.dashboard.ticket-assign-modal', [
            'tickets' => DB::table('tickets')
                ->where('work_order_id', $this->workOrderId)
                ->get(),

            'technicians' => DB::table('technicians')->get(),
        ]);
    }
}
