<x-front::layouts.master>
    <div class="container mt-4">
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                  
                    <x-front::product-card :product="$product" />
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="alert alert-warning">No products available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-front::layouts.master>