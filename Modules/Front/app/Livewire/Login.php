<?php

namespace Modules\Front\app\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('front::components.layouts.master')]
class Login extends Component
{
    public $email, $password, $remember = false;

   
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        // محاولة تسجيل الدخول
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate(); // تأمين الجلسة (Session)

            // لو اليوزر أدمن يروح لوحة التحكم، لو زبون يروح الصفحة الرئيسية
            if (Auth::user()->role == 1) { // افترضنا إن 1 هو الأدمن
                return redirect()->intended('/admin');
            }

            return redirect()->intended('/');
        }

$this->addError('email', 'These credentials do not match our records.');
    }

    public function render()
    {
        return view('front::livewire.login');
    }
}