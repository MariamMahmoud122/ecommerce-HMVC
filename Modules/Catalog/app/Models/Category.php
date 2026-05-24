<?php

namespace Modules\Catalog\app\Models; // ضيفنا كلمة app هنا عشان تطابق المسار الفعلي

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
class Category extends Model
{
    use HasFactory;
use HasTranslations;

   public $translatable = ['name'];
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