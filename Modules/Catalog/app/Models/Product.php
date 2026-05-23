<?php

namespace Modules\Catalog\app\Models; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'category_id',
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