<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::first();
        $user2 = User::all()[1];

        Account::create([
            'users_id' => $user->id,
            'number' => '1234567890123456',
            'name' => 'Tabungan',
        ]);

        Account::create([
            'users_id' => $user2->id,
            'number' => '124125121321',
            'name' => 'Pribadi',
        ]);
    }
}
