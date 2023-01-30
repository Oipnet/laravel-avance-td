<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['libelle' => 'Tee-shirt', 'slug' => 'tee-shirt'],
            ['libelle' => 'Pantalon', 'slug' => 'pantalon'],
        ];

        foreach ($datas as $data) {
            $category = new Category();
            $category->slug = $data['slug'];
            $category->libelle = $data['libelle'];

            $category->save();
        }
    }
}
