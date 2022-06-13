<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\HpUpdate;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StarshipController;
use App\Http\Controllers\SystemController;
use App\Models\Starship;
use App\Models\System;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
})->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/dm-dashboard/{starship?}', [DashboardController::class, 'dmIndex'])->middleware('auth');
Route::post('/img/upload', [DashboardController::class, 'imageUpload'])->middleware('optimizeImages');
Route::get('/new-character', [ModalController::class, 'newCharacter'])->middleware('auth');
Route::post('/new-character', [CharacterController::class, 'store'])->middleware('auth');
Route::get('/edit-character/{characterId}', [ModalController::class, 'editCharacter'])->middleware('auth');
Route::post('/edit-character', [CharacterController::class, 'update'])->middleware('auth');
Route::get('/delete-character/{characterId}', [ModalController::class, 'deleteCharacter'])->middleware('auth');
Route::post('/delete-character/{character}', [CharacterController::class, 'destroy'])->middleware('auth');
Route::get('/new-starship', [ModalController::class, 'newStarship'])->middleware('auth');
Route::post('/new-starship', [StarshipController::class, 'store'])->middleware('auth');
Route::get('/edit-starship/{starshipId}', [ModalController::class, 'editStarship'])->middleware('auth');
Route::post('/edit-starship', [StarshipController::class, 'update'])->middleware('auth');
Route::get('/delete-starship/{starshipId}', [ModalController::class, 'deleteStarship'])->middleware('auth');
Route::post('/delete-starship', [StarshipController::class, 'destroy'])->middleware('auth');
Route::get('character-select/{character}', [CharacterController::class, 'makeActive'])->middleware('auth');
Route::get('starship-select/{starship}', [StarshipController::class, 'makeActive'])->middleware('auth');
Route::get('/character/{character}/division-select/{division}', [CharacterController::class, 'divisionSelect'])->middleware('auth');

Route::get('/dm-mode', function () {
    auth()->user()->is_dm = auth()->user()->is_dm ? false : true;
    auth()->user()->save();
    return view('modals.success', ['message' => 'DM Mode ' . (auth()->user()->is_dm ? 'activated' : 'deactivated') . '!']);
})->middleware('auth');
Route::get('/set-ui-color/{hex}', function ($hex) {
    auth()->user()->ui_color = $hex;
    auth()->user()->save();
    return view('modals.success', ['message' => 'UI Color changed to ' . $hex . '!']);
})->middleware('auth');
Route::get('/get-ui-color', function () {
    return auth()->user()->ui_color;
})->middleware('auth');

Route::get('/starship/{starship}', [StarshipController::class, 'show'])->middleware('auth')->name('overview');
Route::get('/starship/{starship}/division/{division}', [DivisionController::class, 'show'])->middleware('auth')->name('division');
Route::get('/starship/{starship}/division/{division}/new-system', [ModalController::class, 'addSystem'])->middleware('auth');
Route::post('/starship/{starship}/division/{division}/new-system', [SystemController::class, 'store'])->middleware('auth');
Route::get('/delete-system/{system}', [ModalController::class, 'deleteSystem'])->middleware('auth');
Route::post('/delete-system', [SystemController::class, 'destroy'])->middleware('auth');
Route::get('/edit-system/{system}', [ModalController::class, 'editSystem'])->middleware('auth');
Route::post('/edit-system', [SystemController::class, 'update'])->middleware('auth');
Route::get('/starship/{starship}/damage/{damage}', [StarshipController::class, 'takeDamage'])->middleware('auth')->name('damage');
Route::get('/starship/{starship}/reset-damage', [StarshipController::class, 'resetDamage'])->middleware('auth')->name('reset');
Route::get('/starship/{starship}/crew-manifest', [ModalController::class, 'crewManifest'])->middleware('auth')->name('crew');
Route::get('/starship/add-user/{email}/{starship}', [ModalController::class, 'addUser'])->middleware('auth')->name('add-user');

Route::get('/system/{system}/repair/{quickFix}/{dice}', [SystemController::class, 'quickFix'])->middleware('auth')->name('quick-fix');

Route::get('/roll/{starship}', [ModalController::class, 'roll'])->middleware('auth');

Route::post('/register', [RegistrationController::class, 'register'])->middleware('guest');
Route::get('/register', [ModalController::class, 'register'])->middleware('guest');
Route::post('/login', [SessionsController::class, 'login'])->middleware('guest');
Route::get('/login', [ModalController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [SessionsController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/success/{message}', [ModalController::class, 'success'])->name('success');
