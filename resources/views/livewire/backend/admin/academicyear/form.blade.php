<div wire:ignore.self class="modal fade show" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">
                    {{ $academic_id ? 'Edit Tahun Pelajaran' : 'Create Pelajaran' }}
                </h5>
                <button type="button" class="close" wire:click="$set('isModalOpen', false)" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form wire:submit.prevent="save">
                    @csrf


                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="start_year" class="form-label fw-bold">Tahun Awal</label>
                        <input type="number" class="form-control @error('start_year') is-invalid @enderror"
                            id="start_year" wire:model.defer="start_year" onkeyup="updateEndYear()"
                            placeholder="Masukkan Tahun Awal ..." maxlength="4">
                        @error('start_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tahun Akhir Input (Hanya tampil otomatis) -->
                    <div class="mb-3">
                        <label for="end_year" class="form-label fw-bold">Tahun Akhir</label>
                        <input type="number" class="form-control @error('end_year') is-invalid @enderror"
                            id="end_year" wire:model.defer="end_year" value="{{ $end_year }}" readonly>
                        @error('end_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            {{ $academic_id ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
