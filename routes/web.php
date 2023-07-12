<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\PulsaController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'login'], function () {
    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    Route::post('/', [LoginController::class, 'attempt'])->name('login.attempt');
})->middleware('guest');

Route::group(['prefix' => 'register'], function () {
    Route::get('/', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/', [RegisterController::class, 'store'])->name('register.store');
})->middleware('guest');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'transfer'], function () {
        Route::get('/', [TransferController::class, 'index'])->name('transfer.index');
        Route::get('/proses', [TransferController::class, 'create'])->name('transfer.create');
        Route::post('/', [TransferController::class, 'store'])->name('transfer.store');
    });

    Route::group(['prefix' => 'tarik-tunai'], function () {
        Route::get('/', [WithdrawController::class, 'create'])->name('withdraw.create');
        Route::post('/', [WithdrawController::class, 'store'])->name('withdraw.store');
        Route::get('/proses', [WithdrawController::class, 'process'])->name('withdraw.process');
        Route::post('/proses', [WithdrawController::class, 'done'])->name('withdraw.done');
    });

    Route::group(['prefix' => 'mutasi'], function () {
        Route::get('/', [MutationController::class, 'index'])->name('mutation.index');
    });

    Route::group(['prefix' => 'pulsa'], function () {
        Route::get('/', [PulsaController::class, 'create'])->name('pulsa.create');
        Route::post('/', [PulsaController::class, 'store'])->name('pulsa.store');
    });

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});