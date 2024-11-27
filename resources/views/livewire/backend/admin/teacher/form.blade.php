<div wire:ignore.self class="modal fade show" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">
                    {{ $teacher_id ? 'Edit Guru' : 'Create Guru' }}
                </h5>
                <button type="button" class="close" wire:click="$set('isModalOpen', false)" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form wire:submit.prevent="save">
                    @csrf
                    <div class="mb-3">
                        <!-- Image Section -->
                        <label for="photo" class="mb-3 text-center">
                            <div>
                                <img src="{{ empty(!$photo) ? $photo->temporaryUrl() : asset('img/no-image.jpg') }}"
                                    class="rounded img-fluid" alt="Gambar" width="100px">
                            </div>

                        </label>

                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                            wire:model.defer="photo">

                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Guru</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            wire:model.defer="name" placeholder="Masukkan Nama Guru">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Jabatan Guru</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            wire:model.defer="position" placeholder="Masukkan Posisi Guru">
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label fw-bold">Keterangan</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="position" wire:model.defer="position"
                            placeholder="Masukkan Keterangan ... " rows="4"></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            {{ $teacher_id ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
