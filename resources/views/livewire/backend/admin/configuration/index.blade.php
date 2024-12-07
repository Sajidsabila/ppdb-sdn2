<div class="row">
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

    <form wire:submit.prevent="save" class="col-12">
        <div class="row g-3">
            <!-- Kolom pertama -->
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header fw-bold bg-primary text-white">
                        Logo Sekolah
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <label for="foto" class="mb-3">
                            @if ($logo)
                                <img src="{{ $logo->temporaryUrl() }}" alt="Logo Sekolah" class="img-fluid mb-3"
                                    style="max-width: 200px;">
                            @endif
                        </label>
                        <input type="file" class="form-control @error('logo') is-invalid @enderror" id="foto"
                            wire:model="logo">
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Kolom kedua -->
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header fw-bold bg-primary text-white">
                        Data Sekolah
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 my-2">
                                <label for="nama-sekolah" class="fw-bold">Nama Sekolah</label>
                                <input type="text" id="nama-sekolah"
                                    class="form-control @error('name') is-invalid @enderror" wire:model="name"
                                    placeholder="Nama Sekolah">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 my-2">
                                <label for="email-sekolah" class="fw-bold">Email Sekolah</label>
                                <input type="email" id="email-sekolah"
                                    class="form-control @error('email') is-invalid @enderror" wire:model="email"
                                    placeholder="Email Sekolah">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 my-2">
                                <label for="phone-sekolah" class="fw-bold">Nomor Telepon</label>
                                <input type="text" id="phone-sekolah"
                                    class="form-control @error('phone') is-invalid @enderror" wire:model="phone"
                                    placeholder="Nomor Telepon">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 my-2">
                                <label for="website-sekolah" class="fw-bold">Website Sekolah</label>
                                <input type="url" id="website-sekolah"
                                    class="form-control @error('website') is-invalid @enderror" wire:model="website"
                                    placeholder="Website Sekolah">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary btn-md">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
