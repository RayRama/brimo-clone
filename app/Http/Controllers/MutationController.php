<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MutationController extends Controller
{
    public function index(Request $request): View
    {
        $accounts = Account::join('balances', 'accounts.number', '=', 'balances.accounts_number')
            ->where('accounts.users_id', auth()->id())
            ->get();

        $mutations = $request->tanggal == "" ? $this->getAllMutation() : $this->getMutationByDate($request->tanggal);

        $datas = [
            'accounts' => $accounts,
            'mutations' => $mutations
        ];

        return view('mutation.index', compact('datas'));
    }

    private function getMutationByDate($date): Collection
    {
        return Transaction::join('accounts as sender_account', 'transactions.accounts_number', '=', 'sender_account.number')
            ->leftJoin('accounts as recipient_account', 'transactions.recipient', '=', 'recipient_account.number')
            ->leftJoin('users as sender_users', 'sender_account.users_id', '=', 'sender_users.id')
            ->leftJoin('users as recipient_users', 'recipient_account.users_id', '=', 'recipient_users.id')
            ->whereDate('transactions.created_at', $date)
            ->where('sender_account.number', session('accounts_number'))
            ->orWhere('transactions.recipient', session('accounts_number'))
            ->select(
                'sender_users.name as s_name',
                'sender_account.number as s_number',
                'recipient_users.name as r_name',
                'recipient_account.number as r_number',
                'amount',
                'timestamp'
            )
            ->get();
    }

    private function getAllMutation(): Collection
    {
        return Transaction::join('accounts as sender_account', 'transactions.accounts_number', '=', 'sender_account.number')
            ->leftJoin('accounts as recipient_account', 'transactions.recipient', '=', 'recipient_account.number')
            ->leftJoin('users as sender_users', 'sender_account.users_id', '=', 'sender_users.id')
            ->leftJoin('users as recipient_users', 'recipient_account.users_id', '=', 'recipient_users.id')
            ->where('sender_account.number', session('accounts_number'))
            ->orWhere('transactions.recipient', session('accounts_number'))
            ->select(
                'sender_users.name as s_name',
                'sender_account.number as s_number',
                'recipient_users.name as r_name',
                'recipient_account.number as r_number',
                'type',
                'amount',
                'timestamp'
            )
            ->get();
    }
}