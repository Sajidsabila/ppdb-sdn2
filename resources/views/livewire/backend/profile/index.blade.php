<div class="d-flex justify-content-center align-items-center">
    <div class="col-6">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('success'))
            <div class="alert alert-success fw-bold alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Profile</h3>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="update">
                    <div class="mb-3">
                        <label for="name" class="fw-bold">Username</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                            wire:model="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="fw-bold">Email</label>
                        <input type="email" id="email" class="form-control @error('name') is-invalid @enderror"
                            wire:model="email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="fw-bold">Password</label>
                        <input type="password" id="password" placeholder="isi jika ingin password diubah...."
                            class="form-control @error('password') is-invalid @enderror" wire:model="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
