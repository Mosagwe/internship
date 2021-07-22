<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user= User::updateOrCreate([
            'name'=>'Administrator',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password'),
        ]);

       $user->assignRole(Role::find(1));

    }
}
