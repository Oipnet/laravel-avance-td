<?php

namespace Database\Seeders;

use App\Models\OrderState;
use Illuminate\Database\Seeder;

class OrderStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['code' => 'COMMANDE', 'libelle' => 'Commande en cours'],
            ['code' => 'LIVREE', 'libelle' => 'Livrée'],
        ];

        foreach ($datas as $data) {
            $orderState = new OrderState();
            $orderState->code = $data['code'];
            $orderState->libelle = $data['libelle'];

            $orderState->save();
        }
    }
}
