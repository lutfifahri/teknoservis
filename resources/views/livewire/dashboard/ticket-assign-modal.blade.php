<div>
    @if ($show)
        <div class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Assign Technician</h5>
                        <button type="button" class="btn-close" wire:click="$set('show', false)"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Ticket</label>
                            <select class="form-select" wire:model="ticket_id">
                                <option value="">-- pilih ticket --</option>
                                @foreach ($tickets as $ticket)
                                    <option value="{{ $ticket->id }}">
                                        {{ $ticket->ticket_code ?? 'Ticket #' . $ticket->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Technician</label>
                            <select class="form-select" wire:model="technician_id">
                                <option value="">-- pilih teknisi --</option>
                                @foreach ($technicians as $tech)
                                    <option value="{{ $tech->id }}">
                                        {{ $tech->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="$set('show', false)">
                            Cancel
                        </button>

                        <button class="btn btn-primary" wire:click="assign">
                            Assign
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal-backdrop fade show"></div>
    @endif
</div>
