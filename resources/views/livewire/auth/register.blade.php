<div class="register-container">

    <h2 class="text-center mb-4">Register</h2>
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show fw-bold" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form wire:submit.prevent="register">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label text">Full Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                placeholder="Enter your full name" wire:model="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label text">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" placeholder="Enter your email" wire:model="email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label text">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" placeholder="Create a password" wire:model="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label text">Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                id="password_confirmation" name="password_confirmation" placeholder="Confirm your password"
                wire:model="password_confirmation">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <p class="text">Or sign up with</p>
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
        <p class="text">Already have an account? <a href="" class="text-decoration-none text">Login</a></p>
    </div>
</div>
