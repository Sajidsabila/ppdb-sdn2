<div wire:ignore.self class="modal fade show" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">
                    {{ $gallery_id ? 'Edit Kegiatan' : 'Create Kegiatan' }}
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
                                <img src="{{ empty(!$foto) ? $foto->temporaryUrl() : asset('img/no-image.jpg') }}"
                                    class="rounded img-fluid" alt="Student Image" width="100px">
                            </div>

                        </label>

                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="photo"
                            wire:model.defer="foto">

                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Kegiatan</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            wire:model.defer="name" placeholder="Masukkan Nama Kegiatan">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            {{ $gallery_id ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
