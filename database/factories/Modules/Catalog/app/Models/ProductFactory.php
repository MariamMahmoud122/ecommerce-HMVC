<?php

namespace Database\Factories\Modules\Catalog\app\Models;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Catalog\app\Models\Category;

class ProductFactory extends Factory
{
    protected $model = \Modules\Catalog\app\Models\Product::class;

    public function definition(): array
{
   
    $clothes = [
        'Oversized T-shirt', 'Slim Fit Jeans', 'Summer Floral Dress', 
        'Classic Denim Jacket', 'Cotton Hoodie', 'Casual Linen Shirt',
        'Kids Pajama Set', 'Baby Romper Cotton', 'Formal Blazer'
    ];

    $name = $this->faker->randomElement($clothes) . ' ' . $this->faker->unique()->numberBetween(1, 500);

    return [
        'name' => $name,
        'slug' => \Illuminate\Support\Str::slug($name),
        // بيختار قسم عشوائي من اللي إنتي عاملاهم (رجالي، حريمي، أطفال)
        'category_id' => \Modules\Catalog\app\Models\Category::inRandomOrder()->first()->id ?? 1, 
        'description' => $this->faker->sentence(15),
        'price' => $this->faker->numberBetween(200, 2500), 
        'stock' => $this->faker->numberBetween(5, 50),
        'is_visible' => true,
        'image' => 'products/' . $this->faker->randomElement([
            'd.jfif',          
            'men_shirt.jfif',    
            'women_dress.jfif',  
            'kids_outfit.jfif', 
            'c_men.jfif',
            'a.jfif',
            'b.jfif',
            'f_woman.jfif',
            'c.jfif',
            'o.jfif',
        ]),
    ];
}
}