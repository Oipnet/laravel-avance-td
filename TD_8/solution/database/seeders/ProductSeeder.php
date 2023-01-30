<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        $sizes = Size::all();

        Product::factory(15)
            ->make()
            ->each(
                function (Product $product) use ($categories, $sizes) {
                    $randomCategory = $categories->random();
                    $product->category()->associate($randomCategory);

                    $product->save();

                    $product->sizes()->attach($sizes->random(2), ['stock' => rand(0, 10)]);
                });
    }
}
