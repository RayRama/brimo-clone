<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Balance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BalancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $account = Account::first();
        $account2 = Account::all()[1];

        Balance::create([
            'accounts_number' => $account->number,
            'amount' => 1000000,
        ]);

        Balance::create([
            'accounts_number' => $account2->number,
            'amount' => 3000000,
        ]);

    }

}
