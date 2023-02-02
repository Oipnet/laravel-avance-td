<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

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
