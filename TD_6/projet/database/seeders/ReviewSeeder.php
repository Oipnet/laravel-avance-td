<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();

        Review::factory(100)
            ->make()
            ->each(function (Review $review) use ($products) {
                $review->product()->associate($products->random());

                $review->save();
            });
    }
}
