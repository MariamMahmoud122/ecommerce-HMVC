<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        
        @forelse($products as $product)
            <div class="bg-[#fdfaf5] rounded-2xl border border-[#f0e6d2] shadow-sm overflow-hidden flex flex-col h-full">
                
                {{-- السر هنا: ثبتنا الارتفاع بـ 280 بكسل بالظبط --}}
                <div style="height: 280px; width: 100%;" class="bg-white flex items-center justify-center p-4">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             {{-- object-contain بيعرض الصورة كاملة و max-h بيوحد الطول --}}
                             style="max-width: 100%; max-height: 100%; object-fit: contain;" 
                             alt="{{ $product->name }}">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400">
                            <x-heroicon-o-camera style="width: 60px; height: 60px;" />
                        </div>
                    @endif
                </div>

                <div class="p-5 text-center flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 truncate">
                            {{ $product->name }}
                        </h3>
                        
                        <p class="text-xl font-extrabold text-[#b05c6c] mt-2">
                            {{ number_format($product->price, 2) }} <span class="text-xs">EGP</span>
                        </p>
                    </div>

                    <button 
                        style="background-color: #ff8e8e;"
                        class="mt-5 w-full text-white py-3 px-4 rounded-xl font-bold text-sm hover:opacity-90 flex items-center justify-center gap-2"
                    >
                        <x-heroicon-m-shopping-cart class="w-5 h-5" />
                        Add to Cart
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                <p class="text-lg text-gray-500">No products found.</p>
            </div>
        @endforelse

    </div>
</x-filament-panels::page>