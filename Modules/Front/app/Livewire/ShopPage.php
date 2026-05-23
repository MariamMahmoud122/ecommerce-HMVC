<?php

namespace Modules\Front\app\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Modules\Catalog\app\Models\Product;


#[Layout('catalog::components.layouts.master')]
class ShopPage extends Component
{
    use WithPagination;

    public $category = '';
    protected $queryString = ['category' => ['except' => '']];

    public function render()
    {
        $products = Product::query()
            ->where('is_active', 1)
            ->when($this->category, function($query) {
                $query->whereHas('category', function($q) {
                    $q->where('slug', $this->category);
                });
            })
            ->latest()
            ->paginate(12);

        return view('front::livewire.shop-page', ['products' => $products]);
    }
}