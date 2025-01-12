<section id="login-section"
    style="margin-bottom: 50px; display: flex; align-items: center; justify-content: center; min-height: 100vh;">
    <div class="container">
        <div class="section-title text-center mt-5">
            <h2>Forgot Password</h2>
        </div>
        <div class="section-body">
            <div class="card mx-auto"
                style="max-width: 400px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                <div class="card-body">
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

                    <form wire:submit.prevent="sendToken">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label text">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Enter your email" wire:model="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <div wire:loading>
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <button wire:loading.remove type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <div class="mt-4">
                        <p class="text">
                            Kembali ke halaman
                            <a href="{{ route('login') }}" wire:navigate class="text-decoration-none">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
