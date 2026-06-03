<?php

namespace Modules\Catalog\app\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialiteController extends Controller
{
    /**
     * توجيه المستخدم إلى صفحة تسجيل الدخول الخاصة بجوجل.
     */
    public function redirectToGoogle()
    {
        // استخدام stateless() بيمنع مشاكل السيشن المعلقة أثناء الـ Redirect
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * استقبال البيانات القادمة من جوجل بعد موافقة المستخدم.
     */
    public function handleGoogleCallback()
    {
        try {
            // سحب بيانات المستخدم من جوجل
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // 1️⃣ الفحص الأول: البحث بالإيميل (الأضمن دايماً)
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // لو الحساب موجود، بنحدث بيانات جوجل لو مش مربوطة، ونسجل دخوله
                $user->update([
                    'provider_name' => 'google',
                    'provider_id'   => $googleUser->getId(),
                ]);
                
                Auth::login($user, true); // تفعيل الـ Remember me
                return redirect()->to('/'); // التوجيه لصفحة المتجر الرئيسية بالملي 🚀
            }

            // 2️⃣ الفحص الثاني: لو زبون جديد خالص أول مرة يشوف المتجر
            $newUser = User::create([
                'name'          => $googleUser->getName(),
                'email'         => $googleUser->getEmail(),
                'provider_name' => 'google',
                'provider_id'   => $googleUser->getId(),
                'role'          => 0, // عميل عادي
                'password'      => bcrypt(\Str::random(16)), // باسوورد عشوائي آمن لأن بعض الداتابيز تمنع الـ null
            ]);

            Auth::login($newUser, true);
            return redirect()->to('/'); // التوجيه لصفحة المتجر الرئيسية 🚀

        } catch (Exception $e) {
            // 🚨 الحركة السحرية: لو حصل خطأ اطبعيه على الشاشة عشان نشوفه ونعرف العلة فين!
            dd('خطأ في الـ Callback: ' . $e->getMessage());
        }
    }
}