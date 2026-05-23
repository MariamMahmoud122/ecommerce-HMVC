<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh; padding-top: 50px; padding-bottom: 50px;">
    <div class="card shadow-lg border-0" style="width: 100%; max-width: 500px; background-color: #F5F5DC; border: 2px solid #800020 !important; border-radius: 20px;">
        
        <div class="card-body p-5">
            {{-- العنوان --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="color: #800020; letter-spacing: 1px;">CREATE ACCOUNT</h2>
                <p class="text-muted small">Join Mariam Studio Community</p>
            </div>

            {{-- فورم التسجيل --}}
            <form wire:submit.prevent="save">
                
                {{-- الاسم --}}
                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #333;">Full Name</label>
                    <input type="text" wire:model="name" class="form-control border-dark shadow-none @error('name') is-invalid @enderror" placeholder="Enter your name">
                    @error('name') <span class="text-danger small fw-bold">{{ $message }}</span> @enderror
                </div>

                {{-- الإيميل --}}
                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #333;">Email Address</label>
                    <input type="email" wire:model="email" class="form-control border-dark shadow-none @error('email') is-invalid @enderror" placeholder="name@example.com">
                    @error('email') <span class="text-danger small fw-bold">{{ $message }}</span> @enderror
                </div>

                {{-- الباسورد --}}
                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #333;">Password</label>
                    <input type="password" wire:model="password" class="form-control border-dark shadow-none @error('password') is-invalid @enderror" placeholder="Min. 6 characters">
                    @error('password') <span class="text-danger small fw-bold">{{ $message }}</span> @enderror
                </div>

                {{-- تأكيد الباسورد --}}
                <div class="mb-4">
                    <label class="form-label fw-bold" style="color: #333;">Confirm Password</label>
                    <input type="password" wire:model="password_confirmation" class="form-control border-dark shadow-none" placeholder="Re-type password">
                </div>

                {{-- زرار التسجيل --}}
                <button type="submit" class="btn w-100 fw-bold text-white py-3 shadow-sm transition-all" 
                        style="background-color: #800020; border-radius: 10px; font-size: 1.1rem;">
                    <span wire:loading.remove>REGISTER NOW</span>
                    <span wire:loading>Processing...</span>
                </button>

            </form>

            {{-- رابط الدخول --}}
            <div class="text-center mt-4">
                <p class="small mb-0">Already have an account? 
                    <a href="/login" class="fw-bold text-decoration-none" style="color: #800020;">Login Here</a>
                </p>
            </div>
        </div>

    </div>
    
<style>
   
    .btn:hover {
        background-color: #600018 !important;
        transform: translateY(-2px);
    }
    .form-control:focus {
        border-color: #800020 !important;
        background-color: #fff;
    }
</style>
</div>
