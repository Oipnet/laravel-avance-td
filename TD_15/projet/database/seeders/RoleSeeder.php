<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['code' => 'ROLE_ADMIN'],
            ['code' => 'ROLE_SUPREVISOR'],
            ['code' => 'ROLE_USER'],
        ];

        foreach ($datas as $data) {
            $role = new Role();
            $role->code = $data['code'];

            $role->save();
        }
    }
}
