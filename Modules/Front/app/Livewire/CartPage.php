<?php

namespace Modules\Front\app\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Modules\Orders\app\Models\Order;

#[Layout('front::components.layouts.master')]

class CartPage extends Component
{
    public $cart_items = [];
    public $total_price = 0;

    protected $listeners = ['cartUpdated' => 'refreshCart'];

    public function mount()
{
    
    $this->cart_items = session()->get('cart', []);
    
    
    $this->calculateTotal();

    
    session()->forget('unread_count');

    
    $this->dispatch('cartUpdated'); 
}

    public function calculateTotal()
    {
        $this->total_price = collect($this->cart_items)->sum(function($item) {
            return ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
        });
    }

    public function refreshCart()
    {
        $cart = session()->get('cart', []);

        $this->cart_items = array_filter($cart, function($item) {
            return is_array($item);
        });

        $this->calculateTotal(); // 👈 مهم
    }

    public function incrementQty($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }

        session()->put('cart', $cart);
        $this->refreshCart();
    }

    public function decrementQty($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']--;

            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);
        $this->refreshCart();
    }

    public function removeItem($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);
        $this->refreshCart();
    }
 public function placeOrder()
{
   
    if (Auth::check()) {
        $order = Auth::user()->orders()->create([
            'total_price' => $this->total_price,
            'status'      => 'pending',
        ]);
      
    } else {
        return redirect()->route('login')->with('error', 'سجلي دخول الأول يا مريم!');
    }

 
    $orderItems = collect($this->cart_items)->map(function ($item) {
        return [
            'product_id' => $item['product_id'],
            'quantity'   => $item['quantity'],
            'price'      => $item['price'],
        ];
    })->toArray();

    
    $order->items()->createMany($orderItems);

    
    session()->forget(['cart', 'unread_count']);
    return redirect()->route('home')->with('success', 'تم الطلب بنظافة!');
}

    public function render()
    {
        return view('front::livewire.cart-page');
    }
}