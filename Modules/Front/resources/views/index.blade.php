<x-front::layouts.master>
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color: #800020;">Welcome to Our Store</h1>
            <p class="text-muted">Discover the finest timepieces in one place.</p>
        </div>

        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                   
                    <x-front::product-card :product="$product" />
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-light border-dashed p-5">
                        <h3 class="text-muted">No Watches Found!</h3>
                        <p>Stay tuned for our latest collection.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="mt-4">
    {{ $products->links() }}
</div>
</x-front::layouts.master>