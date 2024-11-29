<div wire:ignore.self class="modal fade show" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">
                    {{ $user_id ? 'Edit User' : 'Create User' }}
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
                        <label for="name" class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            wire:model.defer="name" placeholder="Masukkan Username ...">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- email Input -->
                    <div class="mb-3">
                        <label for="position" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="position"
                            wire:model.defer="email" id="email" placeholder="Masukkan Email ...">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="position" class="form-label fw-bold">Role</label>
                        <select name="role" class="form-control @error('role') is-invalid @enderror"
                            wire:model="role">
                            <option value="" selected disabled>-- Pilih Role --</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="operator">Operator</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="position" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="position" wire:model.defer="password" placeholder="Masukkan Password .. ">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            {{ $user_id ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
