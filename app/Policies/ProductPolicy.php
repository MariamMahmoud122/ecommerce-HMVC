<!-- <?php

namespace App\Policies;

use App\Models\User;
use Modules\Catalog\app\Models\Product;
use Illuminate\Auth\Access\Response;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
class ProductPolicy
{
    // مين يقدر يشوف قائمة المنتجات؟
    public function viewAny(User $user): bool
    {
        // هيسمح بالدخول لو اليوزر عنده دور 'super-admin' أو 'catalog-manager'
        return $user->hasAnyRole(['super-admin', 'catalog-manager']);
    }

    // مين يقدر يعدل منتج؟
    public function update(User $user, Product product): bool
    {
        return $user->hasAnyRole(['super-admin', 'catalog-manager']);
    }

    // مين يقدر يمسح منتج؟
    public function delete(User $user, Product product): bool
    {
        return $user->hasRole('super-admin'); // السوبر أدمن بس اللي يمسح!
    }
} -->