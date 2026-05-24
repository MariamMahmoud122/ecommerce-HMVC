<?php

namespace Modules\Catalog\app\Models; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// 🚀 التأكد من استدعاء حزمة الترجمة هنا
use Spatie\Translatable\HasTranslations; 

class Product extends Model
{
    use HasFactory;
    use HasTranslations; // 🚀 تفعيل الحزمة جوه الكلاس عشان الإيرور ده يختفي

    // 🚀 تحديد الحقول المترجمة
    public $translatable = [
        'name',
        'description'
    ];

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'is_visible',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}