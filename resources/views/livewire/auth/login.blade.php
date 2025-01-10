<section id="login-section"
    style="margin-bottom: 50px; display: flex; align-items: center; justify-content: center; min-height: 100vh;">
    <div class="container">
        <div class="section-title text-center">
            <h2>Login</h2>
        </div>
        <div class="section-body">
            <div class="card mx-auto"
                style="max-width: 400px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show fw-bold" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif


                    <form wire:submit.prevent="login">
                        @csrf
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
                                id="password" name="password" placeholder="Enter your password" wire:model="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label text" for="remember">Remember me</label>
                            </div>
                            <a href="" class="text-decoration-none">Forgot Password?</a>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <p class="text">Or login with</p>
                        <div class="social-buttons d-grid gap-2">
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-facebook"></i> Facebook
                            </button>
                            <button class="btn btn-outline-danger">
                                <i class="bi bi-google"></i> Google
                            </button>
                            <button class="btn btn-outline-dark">
                                <i class="bi bi-github"></i> GitHub
                            </button>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text">
                            Don't have an account?
                            <a href="{{ route('register') }}" wire:navigate class="text-decoration-none">Sign Up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
