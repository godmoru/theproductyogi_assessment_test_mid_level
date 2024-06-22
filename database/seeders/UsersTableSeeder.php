<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            'name' => 'User1',
            'email' => 'user1@email.com',
            'password' => bcrypt('password'),
            'user_type' => 1, //Admin User
            'status' => 1
        ]);
        \DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@email.com',
            'password' => bcrypt('password'),
            'user_type' => 2, //Regular User
            'status' => 1
        ]);
        \DB::table('users')->insert([
            'name' => 'Mega Bink',
            'email' => 'm.bink@email.com',
            'password' => bcrypt('password'),
            'user_type' => 2, //Regular User
            'status' => 1
        ]);
        \DB::table('users')->insert([
            'name' => 'Victoria Omoni',
            'email' => 'victoriaomoni@email.com',
            'password' => bcrypt('password'),
            'user_type' => 1, //Regular User
            'status' => 1
        ]);
        \DB::table('users')->insert([
            'name' => 'Matthew Igwe',
            'email' => 'migwe@email.com',
            'password' => bcrypt('password'),
            'user_type' => 2, //Regular User
            'status' => 1
        ]);
        \DB::table('users')->insert([
            'name' => 'Kole Adedeji',
            'email' => 'kole1877@email.com',
            'password' => bcrypt('password'),
            'user_type' => 2, //Regular User
            'status' => 1
        ]);
    }
}
