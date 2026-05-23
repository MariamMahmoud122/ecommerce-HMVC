<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 pt-4 pb-0 text-center">
                    <h2 class="fw-bold" style="color: #800020;">Checkout Details</h2>
                    <p class="text-muted">Please fill in your information to confirm the order</p>
                </div>
                
                <div class="card-body p-4">
                    <form wire:submit.prevent="placeOrder">
               
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" wire:model="name" class="form-control rounded-pill @error('name') is-invalid @enderror" placeholder="Enter your full name">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" wire:model="phone" class="form-control rounded-pill @error('phone') is-invalid @enderror" placeholder="01XXXXXXXXX">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                     
<div class="mb-3">
    <label class="form-label fw-semibold">Email Address</label>
    <input type="email" wire:model="email" class="form-control rounded-pill @error('email') is-invalid @enderror" placeholder="email@example.com">
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
                </div>
                 
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Your Address</label>
                            <textarea wire:model="address" class="form-control rounded-4 @error('address') is-invalid @enderror" rows="3" placeholder="Street name, Building, Apartment..."></textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Additional Notes (Optional)</label>
                            <textarea wire:model="notes" class="form-control rounded-4" rows="2" placeholder="Any special instructions for delivery?"></textarea>
                        </div>

                 
                        <div class="p-3 mb-4 rounded-4 bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Total Amount:</span>
                            <span class="h4 fw-bold mb-0" style="color: #800020;">{{ number_format($total_price, 2) }} EGP</span>
                        </div>
@guest
<div class="card border-0 shadow-sm rounded-4 bg-light mb-4">
    <div class="card-body p-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="createAccount" wire:model.live="showPasswordFields">
            <label class="form-check-label fw-bold" for="createAccount" style="color: #800020;">
                Create your password for later? (Optional)
            </label>
        </div>
        
        @if($showPasswordFields)
    <div class="row mt-3 animate__animated animate__fadeIn">
        <div class="col-md-12 mb-3"> <!-- خليه ياخد العرض كامل أو عدلي التنسيق -->
            <label class="form-label small fw-bold">Set Password</label>
            <input type="password" wire:model="password" class="form-control rounded-pill @error('password') is-invalid @enderror" placeholder="Min. 6 characters">
            @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>
    </div>
@endif
    </div>
</div>
@endguest
                   
                        <!-- رسائل الخطأ تكون بره الزرار -->
@if ($errors->any())
    <div class="alert alert-danger rounded-4 mb-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- الزرار نضيف وواضح -->
<button type="submit" 
        class="btn btn-dark w-100 py-3 rounded-pill fw-bold shadow-sm"
        style="background-color: #800020; border: none;"
        wire:loading.attr="disabled"
        >
    
    <span wire:loading.remove>CONFIRM ORDER</span>
    
    <span wire:loading>
        <span class="spinner-border spinner-border-sm me-2"></span> Processing...
    </span>
</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Success Modal -->
@if($showSuccessModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-body p-5 text-center">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill" style="font-size: 4rem; color: #800020;"></i>
                    </div>
                    <h2 class="fw-bold">Order Placed!</h2>
                    <p class="text-muted">Thank you, <strong>{{ $name }}</strong>. Your order has been received successfully.</p>

                    @if($generatedPassword)
                        <div class="alert alert-light border-dashed p-3 rounded-4 mt-3" style="border: 2px dashed #800020;">
                            <p class="mb-1 small fw-bold text-uppercase text-muted">We created an account for you</p>
                            <h4 class="mb-2" style="color: #800020; font-family: monospace;">{{ $generatedPassword }}</h4>
                            <p class="mb-0 x-small text-muted">You can use this password with your email to login later.</p>
                        </div>
                    @endif

                    <div class="d-grid gap-2 mt-4">
                        <a href="#" class="btn btn-dark py-3 rounded-pill fw-bold" style="background-color: #800020; border: none;">
                            Change Password Now
                        </a>
                        <button type="button" wire:click="closeModal" class="btn btn-link text-muted fw-semibold text-decoration-none">
                            Continue Shopping
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@push('scripts')
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('livewire:init', () => {
      Livewire.on('order-success', (event) => {
    
    const data = Array.isArray(event) ? event[0] : event;
    
    const name = data.name;
    const password = data.password;

    Swal.fire({
        title: 'Success!',
        text: `تم الطلب بنجاح يا ${name}`,
        icon: 'success',
        confirmButtonText: 'الرئيسية'
    }).then(() => {
        window.location.href = "/";
    });
});
    });
</script>
@endpush
@endpush
</div>