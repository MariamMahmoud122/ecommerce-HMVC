<?php

namespace Modules\Front\app\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\Layout; // موجودة تمام
#[Layout('front::components.layouts.master')]
 
class Register extends Component
{
    public $name, $email, $password, $password_confirmation;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ];

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 0,
        ]);

        Auth::login($user);

        return redirect()->to('/');
    }

    public function render()
    {
        return view('front::livewire.register');
    }
}