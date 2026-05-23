<div>
    
    <div class="py-5 text-center" style="background-color: #F5F5DC; border-bottom: 3px solid #800020;">
        <div class="container">
            <h1 class="display-3 fw-black" style="color: #800020; font-weight: 900; letter-spacing: -1px;">
                {{ $category ? strtoupper($category) . ' COLLECTION' : 'OUR COLLECTIONS' }}
            </h1>
            <p class="lead fw-bold text-dark" style="letter-spacing: 2px;">
                PREMIUM QUALITY FOR YOUR STYLE
            </p>
        </div>
    </div>

 
    <div id="shop" class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h6 class="text-uppercase fw-bold" style="color: #FF0000; letter-spacing: 2px;">
                    Filtered Results
                </h6>
                <h2 class="display-6 fw-black" style="color: #1a1a1a; font-weight: 800;">
                    {{ $category ? strtoupper($category) : 'FEATURED PRODUCTS' }}
                </h2>
            </div>
            <div class="text-muted fw-bold">
                Showing {{ $products->total() }} Items
            </div>
        </div>

      
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    {{-- لو عندك الـ Product Card كومبوننت استخدميه هنا --}}
                    <x-front::product-card :product="$product" />
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 rounded-4 border-2 border-dashed" style="border-color: #800020;">
                        <h3 class="text-muted fw-bold">No products found in this category.</h3>
                        <p>Try searching for something else!</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- الترقيم (Pagination) --}}
        <div class="mt-4">
    {{ $products->links('pagination::bootstrap-5') }}
</div>
    </div>
</div>