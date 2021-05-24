<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=[
            'name'=>'Administrator',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password'),
        ];

        User::updateOrCreate($user);

    }
}
