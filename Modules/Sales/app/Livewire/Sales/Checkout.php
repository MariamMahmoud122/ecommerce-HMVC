<?php

namespace Modules\Sales\app\Livewire\Sales;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Modules\Sales\app\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;

#[Layout('front::components.layouts.master')]
class Checkout extends Component
{
    // البيانات الأساسية
    public string $name = '';
    public string $phone = '';
    public string $address = '';
    public ?string $notes = '';
    public $email;
    public $cart_items = [];
    public $total_price = 0;

    // بيانات المودال (الجديد)
    public bool $showSuccessModal = false;
    public bool $showPasswordFields = false;
    public ?string $generatedPassword = null;

  public function mount()
{
   
    $this->cart_items = session()->get('cart', []);

    
    // if (empty($this->cart_items) && !$this->showSuccessModal) {
    //     return redirect()->route('cart');
    // }

    $this->calculateTotal();

    if (Auth::check()) {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }
}

    public function calculateTotal()
    {
        $this->total_price = collect($this->cart_items)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

//worked but try addation 
//     public function placeOrder()
//     {
//         // 1. قواعد التحقق
//         $rules = [
//             'name'    => 'required|min:3',
//             'phone'   => 'required|numeric',
//             'address' => 'required',
//         ];

//         if (!Auth::check()) {
//             $rules['email'] = 'required|email|unique:users,email';
//         }

//         $this->validate($rules);

//         $user = Auth::user();
//         $plainPassword = null;

//         // 2. إنشاء مستخدم جديد إذا كان Guest
//         if (!$user) {
//             $plainPassword = Str::random(8);

//             $user = User::create([
//                 'name'     => $this->name,
//                 'email'    => $this->email,
//                 'password' => bcrypt($plainPassword),
//                 'role'     => 0,
//             ]);

//             Auth::login($user);
//         }

//         // 3. إنشاء الأوردر
//         $order = Order::create([
//             'user_id'       => $user->id,
//             'customer_name' => $this->name,
//             'phone'         => $this->phone,
//             'address'       => $this->address,
//             'notes'         => $this->notes,
//             'total_price'   => $this->total_price,
//             'status'        => 'pending',
//         ]);

//         // 4. إضافة منتجات الأوردر
//         foreach ($this->cart_items as $item) {
//             $order->items()->create([
//                 'product_id' => $item['product_id'],
//                 'quantity'   => $item['quantity'],
//                 'price'      => $item['price'],
//             ]);
//         }

//         // 5. تنظيف السلة
//         session()->forget(['cart', 'unread_count']);

//         // 6. تفعيل المودال بدلاً من الـ Redirect الفوري
//         $this->generatedPassword = $plainPassword;
//         $this->showSuccessModal = true;
//     }

//     public function closeModal()
//     {
//         $this->showSuccessModal = false;
//         return redirect()->route('home');
//     }

//   

//     public function showmessage()
// {
//     $this->placeOrder();

//     if (!$this->getErrorBag()->any()) {
//         // نبعث حدث للمتصفح ومعاه البيانات
//         $this->dispatch('order-success', [
//             'name' => $this->name,
//             'password' => $this->generatedPassword,
//         ]);
//     }
// }
public function placeOrder()
{
    $this->validate([
        'name' => 'required|min:3',
        'phone' => 'required|numeric',
        'address' => 'required',
    ]);

    $user = Auth::user();
    $plainPassword = null;

    if (!$user) {
        $plainPassword = Str::random(8);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($plainPassword),
            'role' => 0,
        ]);

        Auth::login($user);
    }

    $order = Order::create([
        'user_id' => $user->id,
        'customer_name' => $this->name,
        'phone' => $this->phone,
        'address' => $this->address,
        'notes' => $this->notes,
        'total_price' => $this->total_price,
        'status' => 'pending',
    ]);

    foreach ($this->cart_items as $item) {
        $order->items()->create([
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    session()->forget(['cart', 'unread_count']);

    $this->generatedPassword = $plainPassword;
    $this->showSuccessModal = true;
    $this->dispatch('order-success', [
        'name' => $this->name,
        'password' => $plainPassword,
    ]);
}
  public function render()
    {
        return view('sales::livewire.sales.checkout');
    }
}