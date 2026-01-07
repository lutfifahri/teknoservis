<div>
    @if ($show)
        <div class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Work Order Progress</h5>
                        <button type="button" class="btn-close" wire:click="$set('show', false)"></button>
                    </div>

                    <div class="modal-body">

                        {{-- Form tambah progress --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" wire:model="status">
                                <option value="">-- pilih status --</option>
                                <option value="open">Open</option>
                                <option value="on_progress">On Progress</option>
                                <option value="done">Done</option>
                            </select>
                        </div>

                        <button class="btn btn-primary mb-3" wire:click="save">
                            Add Progress
                        </button>

                        <hr>

                        {{-- History --}}
                        <h6>Progress History</h6>

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($progresses as $progress)
                                    <tr>
                                        <td>{{ $progress->status }}</td>
                                        <td>{{ $progress->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No progress yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

        <div class="modal-backdrop fade show"></div>
    @endif
</div>
