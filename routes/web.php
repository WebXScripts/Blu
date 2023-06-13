<?php

use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Dashboard\Helpers\ServersList;
use App\Http\Livewire\Dashboard\Servers\LookUp;
use App\Http\Livewire\Forms\LoginForm;
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

Route::middleware('guest')->group(static function() {
    Route::get('/', LoginForm::class)->name('login-form');
});

Route::middleware('auth')->group(static function() {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

    Route::prefix('servers')->group(static function() {
        Route::get('/', ServersList::class)->name('servers');
        Route::prefix('lookup')->group(static function() {
            Route::get('/{website}', LookUp::class)->name('servers.lookup');
        });
    });
});
