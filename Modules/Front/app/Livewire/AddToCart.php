<?php

namespace Modules\Front\App\Livewire;

use Livewire\Component;
use Modules\Catalog\app\Models\Product;

class AddToCart extends Component
{
    public $productId;

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function add()
    {
        $product = Product::find($this->productId);

        if (!$product) return;

        $cart = session()->get('cart', []);

        if (isset($cart[$this->productId])) {
            $cart[$this->productId]['quantity']++;
        } else {
            $cart[$this->productId] = [
                "product_id" => $product->id,
                "name"       => $product->name,
                "quantity"   => 1,
                "price"      => $product->price,
                "image"      => $product->image
            ];
        }

        session()->put('cart', $cart);

        // --- الزتونة هنا: تحديث عداد التنبيهات غير المقروءة ---
        $unreadCount = session()->get('unread_count', 0);
        session()->put('unread_count', $unreadCount + 1);
        // --------------------------------------------------

        // تحديث باقي الكومبوننتس (زي الـ Navbar عشان يحس بالتغيير)
        $this->dispatch('cartUpdated'); 
    }
    
    public function render()
    {
        return view('front::livewire.add-to-cart');
    }
}