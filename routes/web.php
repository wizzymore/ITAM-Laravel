<?php

use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Assets\AssetEdit;
use App\Http\Livewire\Assets\AssetsShow;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* Public Routes */

Route::get('/', function () {
    return view('welcome');
})->name('home');

/* Guest Only Routes */

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

/* Authenticated Routes */

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/assets', AssetsShow::class)->name('assets');
    Route::get('/assets/edit/{assetId}', AssetEdit::class)->name('asset.edit');

    Route::post('/logout', function () {
        Auth::logout();

        return redirect()->route('login');
    })->name('logout');
});
