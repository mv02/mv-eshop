<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['name' => 'Mléčné výrobky', 'icon' => 'fa-cheese', 'featured' => true],
            ['name' => 'Slané pečivo', 'icon' => 'fa-bread-slice', 'featured' => false],
            ['name' => 'Alkohol', 'icon' => 'fa-wine-glass-alt', 'featured' => true],
            ['name' => 'Nápoje', 'icon' => 'fa-coffee', 'featured' => true],
            ['name' => 'Drogerie', 'icon' => 'fa-soap', 'featured' => true],
            ['name' => 'Masné výrobky', 'icon' => 'fa-bacon', 'featured' => true],
            ['name' => 'Léky', 'icon' => 'fa-first-aid', 'featured' => true],
            ['name' => 'Čisticí prostředky', 'icon' => 'fa-hand-sparkles', 'featured' => false],
            ['name' => 'Ovoce', 'icon' => 'fa-apple-alt', 'featured' => true],
            ['name' => 'Zelenina', 'icon' => 'fa-carrot', 'featured' => true],
            ['name' => 'Kečupy, hořčice, omáčky', 'icon' => null, 'featured' => false],
            ['name' => 'Rýže a těstoviny', 'icon' => null, 'featured' => true],
            ['name' => 'Sladké pečivo', 'icon' => 'fa-birthday-cake', 'featured' => false],
            ['name' => 'Pečivo', 'icon' => 'fa-bread-slice', 'featured' => true],
            ['name' => 'Koření a dochucovadla', 'icon' => 'fa-pepper-hot', 'featured' => false],
            ['name' => 'Sladkosti', 'icon' => 'fa-cookie', 'featured' => true],
            ['name' => 'Slané', 'icon' => null, 'featured' => true],
            ['name' => 'Mražené', 'icon' => 'fa-snowflake', 'featured' => true],
        ]);

        Product::factory()->count(100)->create()->each(function($product) {
            $categories = Category::all()->random(rand(1, 3));
            $product->categories()->saveMany($categories);
            $product->image_url = 'https://picsum.photos/300/200?random=' . $product->id;
            $product->save();
        });
    }
}
