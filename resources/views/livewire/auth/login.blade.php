 <div class="login-container">

     <h2 class="text-center mb-4">Login</h2>
     @if (session('error'))
         <div class="alert alert-danger alert-dismissible fade show fw-bold" role="alert">
             {{ session('error') }}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
     @endif
     <form wire:submit.prevent="login">
         @csrf
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
                 name="password" placeholder="Enter your password" wire:model="password">
             @error('password')
                 <div class="invalid-feedback">{{ $message }}</div>
             @enderror
         </div>
         <div class="d-flex justify-content-between align-items-center">
             <div class="form-check">
                 <input class="form-check-input" type="checkbox" id="remember" name="remember">
                 <label class="form-check-label text" for="remember">Remember me</label>
             </div>
             <a href="" class="text">Forgot Password?</a>
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
     <div class="text-center mt-4 ">
         <p class="text">Don't have an account? <a href="{{ route('register') }}" wire:navigate
                 class="text-decoration-none text">Sign Up</a></p>
     </div>
 </div>
