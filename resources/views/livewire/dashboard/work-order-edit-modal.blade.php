<div>
    @if ($show)
        <div class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Work Order</h5>
                        <button type="button" class="btn-close" wire:click="$set('show', false)"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Work Code</label>
                            <input type="text" class="form-control" wire:model="work_code">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Region</label>
                            <select class="form-select" wire:model="region_id">
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="$set('show', false)">
                            Cancel
                        </button>

                        <button class="btn btn-primary" wire:click="save">
                            Save
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- backdrop --}}
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
