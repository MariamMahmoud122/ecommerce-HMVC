<?php

namespace Modules\Catalog\app\Models; // ضيفنا كلمة app هنا عشان تطابق المسار الفعلي

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;


    /**
     * لازم تملي الـ fillable عشان تقدري تحفظي بيانات القسم
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}