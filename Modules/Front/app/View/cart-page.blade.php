<div class="p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">سلة المشتريات</h2>



    {{-- غيري من $cartItems لـ $cart_items --}}
@if(count($cart_items) > 0)
    <div class="space-y-4">
        @foreach($cart_items as $id => $item)
            {{-- ... باقي الكود ... --}}
        @endforeach

        {{-- في الإجمالي برضه --}}
        <span>{{ collect($cart_items)->sum(fn($i) => $i['price'] * $i['quantity']) }} ج.م</span>
   

            <div class="pt-4 mt-4 border-t border-gray-200">
                <div class="flex justify-between text-xl font-bold">
                    <span>الإجمالي:</span>
                    <span>{{ collect($cartItems)->sum(fn($i) => $i['price'] * $i['quantity']) }} ج.م</span>
                </div>
            </div>

            <button 
                wire:click="placeOrder" 
                wire:loading.attr="disabled"
                class="w-full mt-6 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition"
            >
                <span wire:loading.remove>تأكيد الطلب الآن</span>
                <span wire:loading>جاري معالجة طلبك...</span>
            </button>
        </div>
    @else
        <div class="text-center py-10">
            <p class="text-gray-500">السلة فاضية.. لفي لفة في المحل واشتري حاجة!</p>
        </div>
    @endif
</div>