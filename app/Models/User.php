<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser; 
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Sales\app\Models\Order;
class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * ميثود تحديد من له حق دخول لوحة التحكم
     */
    // public function canAccessPanel(Panel $panel): bool
    // {
       
    //     return (int) $this->role === 1; 
    // }
    public function canAccessPanel(Panel $panel): bool
{
    return true; // جربي دي لثواني واعملي ريفريش للصفحة
}

    /**
     * الحارس اللي بيحط القيم الافتراضية قبل الحفظ
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // لو الـ role مبعوت فاضي، نحدد قيمته بناءً على الرابط
            if (is_null($user->role)) {
                // بنكشف على الـ URL أو الـ Referer عشان نضمن لقط كلمة admin
                if (str_contains(request()->url(), '/admin') || str_contains(request()->header('referer'), '/admin')) {
                    $user->role = 1; 
                } else {
                    $user->role = 0; 
                }
            }
        });


        
    }
   
public function orders()
{
    
    return $this->hasMany(Order::class);
}
}