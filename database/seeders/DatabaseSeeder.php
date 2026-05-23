<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
   
    User::create([
        'name' => 'Mariam Soliman',
        'email' => 'mariam@admin.com',
        'password' => Hash::make('123456'),
        'role' => 1, // Admin
    ]);
    User::create([
        'name' => 'nour',
        'email' => 'nour@admin.com',
        'password' => Hash::make('zxcvb12345!'), 
        'role' => 1, // Admin
    ]);

 
    User::create([
        'name' => 'hoda',
        'email' => 'hoda@test.com',
        'password' => Hash::make('password'),
        'role' => 0, // Customer
    ]);
    User::create([
        'name' => 'ali',
        'email' => 'ali@test.com',
        'password' => Hash::make('password'),
        'role' => 0, // Customer
    ]);

  
    User::factory(100)->create();
    \App\Models\User::factory(100)->create();



// 2.(Categories)
 $cat1 = \Modules\Catalog\app\Models\Category::create([
            'name' => ['en' => 'Men', 'ar' => 'رجال'],
            'slug' => ['en' => 'men', 'ar' => 'رجال'],
            'description' => ['en' => 'Men Collection', 'ar' => 'تشكيلة رجالي'],
        ]);

        $cat2 = \Modules\Catalog\app\Models\Category::create([
            'name' => ['en' => 'Women', 'ar' => 'نساء'],
            'slug' => ['en' => 'women', 'ar' => 'نساء'],
            'description' => ['en' => 'Women Collection', 'ar' => 'تشكيلة حريمي'],
        ]);

        $cat3 = \Modules\Catalog\app\Models\Category::create([
            'name' => ['en' => 'Kids', 'ar' => 'أطفال'],
            'slug' => ['en' => 'kids', 'ar' => 'أطفال'],
            'description' => ['en' => 'Kids Collection', 'ar' => 'تشكيلة أطفالي'],
        ]);
    \Modules\Catalog\app\Models\Product::factory(20)->create();
    // 3. إضافة منتجات حقيقية // 3. إضافة منتجات حقيقية مترجمة بالكامل
    \Modules\Catalog\app\Models\Product::create([
    'name' => 'Black Jacket',
    'slug' => 'black-jacket',
    'category_id' => $cat1->id,
    'description' => 'A sophisticated black Jacket for formal occasions.',
    'price' => 2500, 
    'stock' => 15,   
    'is_visible' => true,
    'image' => 'products/b.jfif', 
]);

\Modules\Catalog\app\Models\Product::create([
    'name' => 'Elegant Rose Gold',
    'slug' => 'elegant-rose-gold',
    'category_id' => $cat2->id,
    'description' => 'Beautiful Dress for women.',
    'price' => 3200,
    'stock' => 10,
    'is_visible' => true,
    'image' => 'products/w.jfif',
]);

\Modules\Catalog\app\Models\Product::create([
    'name' => 'Elegant Rose Gold Kids',
    'slug' => 'elegant-rose-kids',
    'category_id' => $cat3->id, 
    'description' => 'Beautiful Dress for kids.',
    'price' => 3200,
    'stock' => 10,
    'is_visible' => true,
    'image' => 'products/child.jfif',
]);
}
}