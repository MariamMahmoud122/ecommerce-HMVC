<?php

namespace Modules\Catalog\app\Models; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
class Category extends Model
{
    use Sluggable, SluggableScopeHelpers;
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
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name' 
            ]
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}