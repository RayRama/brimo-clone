<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransferController extends Controller
{
    public function index(): View
    {
        return view('transfer.index');
    }

    public function create(Request $request): View | RedirectResponse
    {
        $accounts = Account::join('balances', 'accounts.number', '=', 'balances.accounts_number')
            ->where('accounts.users_id', auth()->id())
            ->get();

        if(!$request->recipient){
            return redirect()->route('transfer.index')->with('errors', 'Nomor Rekening Tidak Ditemukan');
        }

        $recipient = Account::join('users', 'accounts.users_id', '=', 'users.id')
            ->where('number', $request->recipient)
            ->select('users.name', 'number')
            ->first();

        if(!$recipient){
            return redirect()->route('transfer.index')->with('errors', 'Nomor Rekening Tidak Ditemukan');
        }

        $datas = [
            'accounts' => $accounts,
            'recipient' => $recipient
        ];

        return view('transfer.create', compact('datas'));
    }

    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'accounts_number' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
            'recipient' => 'required',
            'status' => 'required'
        ]);
        try {
            $balanceCheck = Balance::where('accounts_number', $request->accounts_number)
                ->first();

            Transaction::create($validatedData);

            if ($balanceCheck && $balanceCheck->amount >= $request->amount) {
                $balanceCheck->decrement('amount', $request->amount);

                Balance::where('accounts_number', $request->recipient)
                    ->increment('amount', $request->amount);
            } else {
                DB::rollBack();
                return redirect()->back()->withErrors('Saldo tidak cukup');
            }

            DB::commit();

            return redirect()->route('transfer.index')->with('success', 'Berhasil Transfer');
        } catch (\Exception $e) {
            DB::rollBack();
            error_log($e);
            return redirect()->back()->with('errors', 'Sistem error ketika proses transaksi');
        }
    }

}
