<section id="login-section"
    style="margin-bottom: 50px; display: flex; align-items: center; justify-content: center; min-height: 100vh;">
    <div class="container">
        <div class="section-title text-center mt-5">
            <h2>Reset Password</h2>
        </div>
        <div class="section-body">
            <div class="card mx-auto"
                style="max-width: 400px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                <div class="card-body">
                    <!-- Flash Messages -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show fw-bold" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session('success'))
                        <div class="alert alert-success alert-dismissible fade show fw-bold" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Form -->
                    <form wire:submit.prevent="resetPassword" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control @error('token')is-invalid @enderror"
                                wire:model="token">
                            @error('token')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="hidden" class="form-control @error('email') is-invalid @enderror"
                                wire:model="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-flat">
                                <input type="password" id="password"
                                    class="form-control @error('password')is-invalid @enderror"
                                    placeholder="Enter new password" wire:model="password" autocomplete="off">
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Show password"
                                        data-bs-toggle="tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </span>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group input-group-flat">
                                <input type="password" id="password_confirmation"
                                    class="form-control @error('password_confirmation')is-invalid @enderror"
                                    placeholder="Confirm your password" wire:model="password_confirmation"
                                    autocomplete="off">
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Show password"
                                        data-bs-toggle="tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </span>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <div wire:loading>
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <button wire:loading.remove type="submit" class="btn btn-primary w-100">Simpan
                                Password</button>
                        </div>
                    </form>

                    <div class="mt-4 text-center">
                        <p>
                            Kembali ke halaman
                            <a href="{{ route('login') }}" wire:navigate class="text-decoration-none">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
