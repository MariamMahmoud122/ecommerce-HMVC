<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh; padding-top: 50px; padding-bottom: 50px;">
    <div class="card shadow-lg border-0" style="width: 100%; max-width: 500px; background-color: #F5F5DC; border: 2px solid #800020 !important; border-radius: 20px;">
        
        <div class="card-body p-5">
          
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="color: #800020; letter-spacing: 1px;">WELCOME BACK</h2>
                <p class="text-muted small">Login to Mariam Studio Account</p>
            </div>

          
            <form wire:submit.prevent="login">
                
          
                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #333;">Email Address</label>
                    <input type="email" wire:model="email" class="form-control border-dark shadow-none @error('email') is-invalid @enderror" placeholder="name@example.com">
                    @error('email') <span class="text-danger small fw-bold">{{ $message }}</span> @enderror
                </div>

      
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label fw-bold" style="color: #333;">Password</label>
                        <a href="#" class="small text-decoration-none" style="color: #800020;">Forgot Password?</a>
                    </div>
                    <input type="password" wire:model="password" class="form-control border-dark shadow-none @error('password') is-invalid @enderror" placeholder="Enter your password">
                    @error('password') <span class="text-danger small fw-bold">{{ $message }}</span> @enderror
                </div>

         
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input border-dark shadow-none" id="remember" wire:model="remember">
                    <label class="form-check-label small" for="remember" style="color: #333; cursor: pointer;">Remember me</label>
                </div>

         
                <button type="submit" class="btn w-100 fw-bold text-white py-3 shadow-sm transition-all" 
                        style="background-color: #800020; border-radius: 10px; font-size: 1.1rem;">
                    <span wire:loading.remove wire:target="login">LOGIN NOW</span>
                    <span wire:loading wire:target="login">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Authenticating...
                    </span>
                </button>

            </form>

      
            <div class="text-center mt-4">
                <p class="small mb-0">Don't have an account? 
                    <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: #800020;">Create Account</a>
                </p>
            </div>
        </div>

    </div>

    <style>
        .btn:hover {
            background-color: #600018 !important;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #800020 !important;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(128, 0, 32, 0.2) !important;
        }
        .form-check-input:checked {
            background-color: #800020 !important;
            border-color: #800020 !important;
        }
    </style>
</div>