<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $account = Account::join('balances', 'accounts.number', '=', 'balances.accounts_number')
            ->where('accounts.users_id', auth()->id())
            ->first();

        $pengeluaran = Transaction::where(function ($query) {
            $query->where('type', 'withdraw')
                ->orWhere('type', 'pulsa');
        })->where('accounts_number', $account->number)
            ->sum('amount');

        $pemasukan = Transaction::where('type', 'transfer')
            ->where('recipient', $account->number)
            ->sum('amount');

        $data = [
            'account' => $account,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran
        ];

        return view('index', compact('data'));
    }
}
