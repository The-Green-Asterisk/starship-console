<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\HpUpdate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\StarshipController;
use App\Models\Starship;

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

Route::get('/starship/{starship}', [StarshipController::class, 'show'])->name('home');
Route::get('/starship/{starship}/damage/{damage}', [StarshipController::class, 'takeDamage'])->name('damage');
Route::get('/starship/{starship}/reset-damage', [StarshipController::class, 'resetDamage'])->name('reset');



Route::get('/listen', function () {
    return view('event-listener', ['consoleData' => null]);
});

Route::get('/login', [ModalController::class, 'login'])->name('login');
Route::get('/roll/{starship}', [ModalController::class, 'roll']);
