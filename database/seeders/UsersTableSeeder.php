<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create and insert users
        User::create([
            'id_number' => '1217050122',
            'name' => 'Rifky Zaini Faroj',
            'email' => 'rifky@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'id_number' => '1231248219',
            'name' => 'Joko Widodo',
            'email' => 'jokowi@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }

}
