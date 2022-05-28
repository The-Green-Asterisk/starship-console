<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\HpUpdate;
use App\Http\Controllers\Controller;
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

Route::get('/', [Starship::class, 'index'])->name('home');

Route::get('/damage/{starship}/{damage}', function ($starship, $damage) {
    $starship = Starship::find($starship);
    $starship->takeDamage($damage);
});

Route::get('/reset/{starship}', function ($starship) {
    $starship = Starship::find($starship);
    $starship->resetDamage();
    return redirect()->back();
});

Route::get('/listen', function () {
    return view('event-listener', ['consoleData' => null]);
});
