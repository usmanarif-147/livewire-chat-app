<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        $users = [
            [
                'name' => 'usman',
                'email' => 'usman@gmail.com',
                'password' => bcrypt('11223344')
            ],
            [
                'name' => 'junaid',
                'email' => 'junaid@gmail.com',
                'password' => bcrypt('11223344')
            ],
            [
                'name' => 'ans',
                'email' => 'ans@gmail.com',
                'password' => bcrypt('11223344')
            ],
            [
                'name' => 'faiza',
                'email' => 'faiza@gmail.com',
                'password' => bcrypt('11223344')
            ],
            [
                'name' => 'aiza',
                'email' => 'aiza@gmail.com',
                'password' => bcrypt('11223344')
            ],
            [
                'name' => 'fatima',
                'email' => 'fatima@gmail.com',
                'password' => bcrypt('11223344')
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
