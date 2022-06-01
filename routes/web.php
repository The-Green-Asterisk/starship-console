<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\HpUpdate;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionsController;
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

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }else{
        return view('welcome');
    }
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/new-character', [ModalController::class, 'newCharacter'])->middleware('auth');
Route::post('/new-character', [CharacterController::class, 'store'])->middleware('auth');
Route::get('/new-starship', [ModalController::class, 'newStarship'])->middleware('auth');
Route::post('/new-starship', [StarshipController::class, 'store'])->middleware('auth');
Route::get('character-select/{character}', [CharacterController::class, 'makeActive'])->middleware('auth');
Route::get('starship-select/{starship}', [StarshipController::class, 'makeActive'])->middleware('auth');

Route::get('/starship/{starship}', [StarshipController::class, 'show'])->name('home');
Route::get('/starship/{starship}/damage/{damage}', [StarshipController::class, 'takeDamage'])->name('damage');
Route::get('/starship/{starship}/reset-damage', [StarshipController::class, 'resetDamage'])->name('reset');

Route::get('/roll/{starship}', [ModalController::class, 'roll'])->middleware('auth');

Route::get('/register', [ModalController::class, 'register'])->middleware('guest');
Route::post('/register', [RegistrationController::class, 'register'])->middleware('guest');
Route::get('/login', [ModalController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [SessionsController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [SessionsController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/success/{message}', [ModalController::class, 'success'])->name('success');
