<div>
    <div class="row mb-3">
        <div class="col-md-3">
            <select class="form-select" wire:model.defer="status">
                <option value="">All Status</option>
                <option value="open">Open</option>
                <option value="on_progress">On Progress</option>
                <option value="done">Done</option>
            </select>
        </div>

        <div class="col-md-3">
            <select class="form-select" wire:model.defer="region">
                <option value="">All Region</option>
                @foreach ($regions as $r)
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <input type="date" class="form-control" wire:model.defer="dateFrom">
        </div>

        <div class="col-md-3">
            <input type="date" class="form-control" wire:model.defer="dateTo">
        </div>

        <div class="col-md-12 mt-2">
            <button class="btn btn-primary" wire:click="$refresh">
                Filter
            </button>
        </div>
    </div>


    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Work Code</th>
                <th>Status</th>
                <th>Region</th>
                <th>Total Ticket</th>
                <th>Open Ticket</th>
                <th>Progress</th>
                <th>Last Update</th>
                <th>jumlah teknisi ter-assign</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($workOrders as $wo)
                <tr>
                    <td>{{ $wo->work_code }}</td>
                    <td>{{ $wo->last_status }}</td>
                    <td>{{ $wo->region }}</td>
                    <td>{{ $wo->total_tickets }}</td>
                    <td>{{ $wo->open_tickets }}</td>
                    <td>{{ $wo->total_progress }}</td>
                    <td>{{ $wo->last_progress_update }}</td>
                    <td>{{ $wo->total_technicians }}</td>
                    <td>
                        <button wire:click="openProgress({{ $wo->id }})" class="btn btn-sm btn-info">
                            Progress
                        </button>


                        <button wire:click="openAssign({{ $wo->id }})" class="btn btn-sm btn-warning">
                            Assign Technician
                        </button>

                        <button wire:click="openEdit({{ $wo->id }})" class="btn btn-sm btn-primary">
                            Work Order Edit
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $workOrders->links() }}
</div>
