<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\Balance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index(): View
    {
        return view('register');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'id_number' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            $user = User::create($validatedData);
            $account = Account::create([
                'users_id' => $user->id,
                'number' => mt_rand(1000000000, 9999999999),
                'name' => 'Tabungan'
            ]);

            Balance::create([
                'accounts_number' => $account->number,
                'amount' => 0
            ]);

            DB::commit();
            return redirect()->route('login.index');
        } catch (\Exception $e) {
            DB::rollBack();
            error_log($e);
            return redirect()->back()->with('errors', 'Kesalahan Sistem');
        }
    }
}