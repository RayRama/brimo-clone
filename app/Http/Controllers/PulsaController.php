<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Balance;
use App\Models\Pulsa;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PulsaController extends Controller
{
    public function create(): View
    {
        $accounts = Account::join('balances', 'accounts.number', '=', 'balances.accounts_number')
            ->where('accounts.users_id', auth()->id())
            ->get();

        return view('pulsa.create', compact('accounts'));
    }

    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();

        $phone_number = $request->phone_number;
        $validatedTransactionData = $request->validate([
            'accounts_number' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
            'recipient' => 'nullable',
            'status' => 'required'
        ]);

        try {
            $balanceCheck = Balance::where('accounts_number', $request->accounts_number)
                ->first();

            if ($balanceCheck && $balanceCheck->amount >= $request->amount) {
                $balanceCheck->decrement('amount', $request->amount);

                $transaction = Transaction::create($validatedTransactionData);
                Pulsa::create([
                    'transactions_id' => $transaction->id,
                    'phone_number' => $phone_number
                ]);
            } else {
                DB::rollBack();
                return redirect()->back()->with('errors', 'Saldo tidak cukup');
            }

            DB::commit();

            return redirect()->route('pulsa.create')->with('success', 'Berhasil Top Up Pulsa '.$phone_number);
        } catch (\Exception $e) {
            DB::rollBack();
            error_log($e);
            return redirect()->back()->with('errors', 'Sistem error ketika proses transaksi');
        }
    }
}
