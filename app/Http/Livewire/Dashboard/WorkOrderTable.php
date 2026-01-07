<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class WorkOrderTable extends Component
{
    use WithPagination;


    public $status;
    public $region;
    public $dateFrom;
    public $dateTo;

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];
    protected $paginationTheme = 'bootstrap';

    public function openEdit($id)
    {
        $this->emit('openEditModal', $id);
    }

    public function openAssign($workOrderId)
    {
        $this->emit('openAssignModal', $workOrderId);
    }

    public function openProgress($workOrderId)
    {
        $this->emit('openProgressModal', $workOrderId);
    }


    public function render()
    {
        $query = DB::table('work_orders as wo')
            ->join('regions as r', 'r.id', '=', 'wo.region_id')

            ->leftJoin('work_order_progresses as wp', 'wp.id', '=', DB::raw('(
        SELECT wpp.id
        FROM work_order_progresses wpp
        WHERE wpp.work_order_id = wo.id
        ORDER BY wpp.created_at DESC
        LIMIT 1
    )'))

            ->leftJoin('tickets as t', 't.work_order_id', '=', 'wo.id')

            ->selectRaw('
        wo.id,
        wo.work_code,
        r.name as region,

        wp.status as last_status,
        COUNT(DISTINCT t.id) as total_tickets,
        SUM(t.status = "open") as open_tickets,
        COUNT(DISTINCT wp.id) as total_progress,
        wp.created_at as last_progress_update,

        (
            SELECT COUNT(DISTINCT ta.technician_id)
            FROM ticket_assignments ta
            JOIN tickets tt ON tt.id = ta.ticket_id
            WHERE tt.work_order_id = wo.id
        ) as total_technicians
    ')
            ->groupBy(
                'wo.id',
                'wo.work_code',
                'r.name',
                'wp.status',
                'wp.created_at'
            );

        # filter
        if ($this->region) {
            $query->where('wo.region_id', $this->region);
        }

        if ($this->status) {
            $query->where('wp.status', $this->status);
        }

        if ($this->dateFrom && $this->dateTo) {
            $query->whereBetween('wo.created_at', [
                $this->dateFrom . ' 00:00:00',
                $this->dateTo . ' 23:59:59',
            ]);
        }


        return view('livewire.dashboard.work-order-table', [
            'workOrders' => $query->paginate(10),
            'regions' => DB::table('regions')->get(),
        ]);
    }
}
