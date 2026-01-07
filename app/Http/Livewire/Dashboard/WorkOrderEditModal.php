<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class WorkOrderEditModal extends Component
{
    public $show = false;
    public $workOrderId;

    public $work_code;
    public $region_id;

    protected $listeners = ['openEditModal'];

    public function openEditModal($workOrderId)
    {
        $this->workOrderId = $workOrderId;

        $workOrder = DB::table('work_orders')
            ->where('id', $workOrderId)
            ->first();

        $this->work_code = $workOrder->work_code;
        $this->region_id = $workOrder->region_id;

        $this->show = true;
    }

    public function save()
    {
        DB::table('work_orders')
            ->where('id', $this->workOrderId)
            ->update([
                'work_code' => $this->work_code,
                'region_id' => $this->region_id,
                'updated_at' => now(),
            ]);

        // refresh table
        $this->emit('refreshTable');

        // tutup modal
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.dashboard.work-order-edit-modal', [
            'regions' => DB::table('regions')->get()
        ]);
    }
}
