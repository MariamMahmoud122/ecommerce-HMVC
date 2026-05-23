<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 py-3">
                 
                   <h5 class="mb-0 fw-bold" style="color: #800020;">
                    Shopping Cart ({{ count($cart_items ?? []) }} Items)
                  </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-muted small uppercase">
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                @forelse($cart_items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{-- بنجيب صورة المنتج واسمه من الداتا اللي اخترتيها --}}
                                                <img src="{{ asset('storage/' . $item['image']) }}" class="rounded-3 me-3" style="width: 70px; height: 70px; object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-0 fw-bold">{{ $item['name'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-bold">{{ number_format($item['price'], 2) }} EGP</td>
                                        <td>
                                            <div class="d-flex align-items-center border rounded-pill px-2" style="width: fit-content;">
                                                <button class="btn btn-sm border-0" wire:click="decrementQty({{ $item['product_id'] }})">-</button>
                                                <span class="px-3 fw-bold">{{ $item['quantity'] }}</span>
                                                <button class="btn btn-sm border-0" wire:click="incrementQty({{ $item['product_id'] }})">+</button>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-dark">{{ number_format($item['price'] * $item['quantity'], 2) }} EGP</td>
                                        <td>
                                            <button class="btn btn-link text-danger p-0" wire:click="removeItem({{ $item['product_id'] }})">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <h4 class="text-muted">Your cart is empty!</h4>
                                            <a href="{{ route('shop') }}" class="btn btn-dark mt-3 rounded-pill">Shop Now</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- جزء ملخص الحساب --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 bg-light p-4">
                <h5 class="fw-bold mb-4">Order Summary</h5>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Total Price</span>
                    <span class="h5 fw-bold" style="color: #800020;">{{ number_format($total_price, 2) }} EGP</span>
                </div>
               
<a href="{{ route('checkout') }}" 
   class="btn btn-dark w-100 py-3 rounded-pill fw-bold"
   style="background-color: #800020; border: none;">
    PROCEED TO CHECKOUT
</a>


               
            </div>
        </div>
    </div>
</div>