<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Balance;
use App\Models\Transaction;
use App\Models\Withdraw;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Carbon\Carbon;

class WithdrawController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if ($this->isExist()) {
            return redirect()->route('withdraw.process');
        }

        $accounts = Account::join('balances', 'accounts.number', '=', 'balances.accounts_number')
            ->where('accounts.users_id', auth()->id())
            ->get();

        return view('withdraw.create', compact('accounts'));
    }

    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
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

                $transaction = Transaction::create($validatedData);

                Withdraw::create([
                    'transactions_id' => $transaction->id,
                    'code' => random_int(100000, 999999),
                    'expired' => Carbon::now()->addHour()
                ]);
            } else {
                DB::rollBack();
                return redirect()->back()->with('errors', 'Saldo tidak cukup');
            }

            DB::commit();

            return redirect()->route('withdraw.create')->with('success', 'Berhasil Tarik Tunai');
        } catch (\Exception $e) {
            DB::rollBack();
            error_log($e);
            return redirect()->back()->with('errors', 'Sistem error ketika proses transaksi');
        }
    }

    public function process(): View
    {
        $withdraw = Transaction::where('accounts_number', session('accounts_number'))
            ->where('type', 'withdraw')
            ->where('status', 'pending')
            ->first();

        return view('withdraw.process', compact('withdraw'));
    }

    public function done(Request $request): RedirectResponse
    {
        $transaction = Transaction::find($request->id);
        $transaction->status = 'completed';
        $transaction->save();

        return redirect()->route('home');
    }

    private function isExist(): bool
    {
        $withdraw = Transaction::where('accounts_number', session('accounts_number'))
            ->where('type', 'withdraw')
            ->where('status', 'pending')
            ->first();

        if ($withdraw) {
            return true;
        }

        return false;
    }
}