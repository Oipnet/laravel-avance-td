<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['code' => 'S', 'libelle' => 'Small'],
            ['code' => 'M', 'libelle' => 'Medium'],
            ['code' => 'L', 'libelle' => 'Large'],
            ['code' => 'XL', 'libelle' => 'Extra large'],
        ];

        foreach ($datas as $data) {
            $size = new Size();
            $size->code = $data['code'];
            $size->libelle = $data['libelle'];

            $size->save();
        }
    }
}
