<?php

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

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/logout', function () {
    Auth::logout();
});

/* Guest Only Routes */

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::middleware('guest')->get('/register', Register::class)->name('register');
});
