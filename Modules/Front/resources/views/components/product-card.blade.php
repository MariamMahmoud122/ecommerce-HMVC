@props(['product'])

<div class="card h-100 border-0 shadow transition-all hover-shadow-lg" style="background-color: #F5F5DC; border-radius: 12px; overflow: hidden; border: 2px solid #800020 !important;">
    
    {{-- خلفية بيضاء صريحة للصورة عشان المنتج يظهر --}}
    <div style="height: 280px; background-color: #ffffff; display: flex; align-items: center; justify-content: center; padding: 10px;">
        <img src="{{ asset('storage/' . $product->image) }}" 
             style="max-width: 100%; max-height: 100%; object-fit: contain;" 
             alt="{{ $product->name }}">
    </div>

    <div class="card-body d-flex flex-column p-4 text-center">
        {{-- اسم المنتج بلون أسود صريح --}}
        <h5 class="fw-bold text-dark mb-2" style="font-size: 1.2rem; letter-spacing: 0.5px;">
            {{ strtoupper($product->name) }}
        </h5>
        
        {{-- السعر بالبورجندي الغامق (زاهر وقوي) --}}
        <p class="fw-black mt-auto mb-3" style="color: #800020; font-size: 1.5rem; font-weight: 900;">
            {{ number_format($product->price, 2) }} <small class="fw-normal">EGP</small>
        </p>

        {{-- زرار أحمر ناري (ساقع وزاهر) --}}
       {{-- استبدلي الزرار القديم بالسطر ده --}}

{{-- استخدمي الاسم المختصر 'add-to-cart' اللي سجلناه في الـ Provider --}}
@livewire('add-to-cart', ['productId' => $product->id], key('cart-btn-'.$product->id))
    </div>
</div>