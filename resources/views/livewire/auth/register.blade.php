<section id="register-section"
    style="margin-bottom: 50px; display: flex; align-items: center; justify-content: center; min-height: 100vh;">
    <div class="container">
        <div class="section-title text-center mt-5">
            <h2>Register</h2>
        </div>
        <div class="section-body">
            <div class="card mx-auto"
                style="max-width: 500px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px;">
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

                    <form wire:submit.prevent="register">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label text">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="Enter your full name" wire:model="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label text">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Enter your email" wire:model="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Create a password" wire:model="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label text">Confirm Password</label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm your password" wire:model="password_confirmation">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text">
                            Already have an account?
                            <a href="{{ route('login') }}" wire:navigate class="text-decoration-none">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
