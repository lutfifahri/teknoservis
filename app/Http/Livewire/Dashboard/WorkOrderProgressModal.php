<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class WorkOrderProgressModal extends Component
{
    public $show = false;
    public $workOrderId;

    public $status;

    protected $listeners = ['openProgressModal'];

    public function openProgressModal($workOrderId)
    {
        $this->workOrderId = $workOrderId;
        $this->reset(['status']);
        $this->show = true;
    }

    public function save()
    {
        DB::table('work_order_progresses')->insert([
            'work_order_id' => $this->workOrderId,
            'status' => $this->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // refresh table utama
        $this->emit('refreshTable');

        // tutup modal
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.dashboard.work-order-progress-modal', [
            'progresses' => DB::table('work_order_progresses')
                ->where('work_order_id', $this->workOrderId)
                ->orderByDesc('created_at')
                ->get(),
        ]);
    }
}
