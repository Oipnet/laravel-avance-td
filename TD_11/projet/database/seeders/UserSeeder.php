<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::where('code', 'ROLE_ADMIN')->first();
        $roleSupervisor = Role::where('code', 'ROLE_SUPREVISOR')->first();

        $user = new User;
        $user->name = 'Arnaud POINTET';
        $user->email = 'arnaud.pointet@gmail.com';
        $user->password = Hash::make('password');
        $user->save();
        $user->roles()->attach([$roleAdmin->id, $roleSupervisor->id]);

        $user2 = new User;
        $user2->name = 'Test Demo';
        $user2->email = 'test@demo.fr';
        $user2->password = Hash::make('password');
        $user2->save();
        $user2->roles()->attach([$roleSupervisor->id]);
    }
}
