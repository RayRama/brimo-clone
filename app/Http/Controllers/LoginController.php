<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('login');
    }

    public function attempt(Request $request): RedirectResponse
    {
        try {
            $credentials = $request->only('email', 'password');

            if (auth()->attempt($credentials)) {
                $account_number = Account::where('users_id', auth()->id())
                    ->select('number')->first();
                session(['accounts_number' => $account_number->number]);
                return redirect()->route('home');
            }

            return redirect()->back()->with('errors', 'Email atau Password Salah');
        } catch (\Exception $e) {
            error_log($e);
            return redirect()->back()->with('errors', 'Kesalahan Sistem');
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

}