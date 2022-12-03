<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::find(1);

        $mehedi = User::create([
            'first_name' => 'Mehedi',
            'last_name' => 'Hassan',
            'email' => 'MehediDracula@gmail.com',
            'password' => bcrypt(123456),
        ]);

        $activation = Activation::create($mehedi);
        Activation::complete($mehedi, $activation->code);

        $adminRole->users()->attach($mehedi);

        $sujon = User::create([
            'first_name' => 'FI',
            'last_name' => 'Sujon',
            'email' => 'fisujon20@gmail.com',
            'password' => bcrypt(123456),
        ]);

        $activation = Activation::create($sujon);
        Activation::complete($sujon, $activation->code);

        $adminRole->users()->attach($sujon);
    }
}
