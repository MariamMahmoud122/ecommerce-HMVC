<?php

namespace Modules\Front\app\Livewire;

use Livewire\Component;

class CartCounter extends Component
{
    // بنخلي الكومبوننت يسمع أول ما السلة تتحدث عشان يغير الرقم لايف
    protected $listeners = ['cartUpdated' => '$refresh'];

    public function render()
    {
        // بنقرأ العداد اللي لسه "مقروءش" من السشن
        $count = session()->get('unread_count', 0);

        return view('front::livewire.cart-counter', [
            'count' => $count
        ]);
    }
}