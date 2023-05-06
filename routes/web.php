<?php

use App\Http\Controllers\CargoItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StarshipController;
use App\Http\Controllers\SystemController;
use Illuminate\Notifications\Messages\MailMessage;

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

//Home Base
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }else{
        return view('welcome');
    }
})->name('home');

//Setup actions and settings
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
Route::get('/character-select/{character}', [CharacterController::class, 'makeActive'])->middleware('auth');
Route::get('/starship-select/{starship}/{character?}', [StarshipController::class, 'makeActive'])->middleware('auth');
Route::get('/character/{character}/division-select/{division}', [CharacterController::class, 'divisionSelect'])->middleware('auth');
Route::get('/dm-mode', [DashboardController::class, 'dmMode'])->middleware('auth');
Route::get('/set-ui-color/{hex}', [DashboardController::class, 'setUiColor'])->middleware('auth');
Route::get('/get-ui-color', function () {return auth()->user()->ui_color;})->middleware('auth');
Route::get('/orientation', function () {return view('modals.orientation');})->middleware('guest');
Route::get('/disembark/{character}', [StarshipController::class, 'disembark'])->middleware('auth');

//navigation and maintenance
Route::get('/starship/{starship}', [StarshipController::class, 'show'])->middleware('auth')->name('overview');
Route::get('/starship/{starship}/division/{division}', [DivisionController::class, 'show'])->middleware('auth')->name('division');
Route::get('/starship/{starship}/division/{division}/new-system', [ModalController::class, 'addSystem'])->middleware('auth');
Route::post('/starship/{starship}/division/{division}/new-system', [SystemController::class, 'store'])->middleware('auth');
Route::get('/delete-system/{system}', [ModalController::class, 'deleteSystem'])->middleware('auth');
Route::post('/delete-system', [SystemController::class, 'destroy'])->middleware('auth');
Route::get('/edit-system/{system}', [ModalController::class, 'editSystem'])->middleware('auth');
Route::post('/edit-system', [SystemController::class, 'update'])->middleware('auth');
Route::get('/starship/add-user/{email}/{starship}', [ModalController::class, 'addUser'])->middleware('auth')->name('add-user');

//manifest
Route::get('/starship/{starship}/crew-manifest', [ModalController::class, 'crewManifest'])->middleware('auth')->name('crew');
Route::get('/starship/{starship}/cargo-manifest', [ModalController::class, 'cargoManifest'])->middleware('auth')->name('cargo');
Route::post('/add-cargo', [CargoItemController::class, 'store'])->middleware('auth')->name('add-cargo');
Route::post('/delete-cargo/{cargoItem}', [CargoItemController::class, 'destroy'])->middleware('auth')->name('delete-cargo');
Route::post('/update-cargo/{cargoItem}', [CargoItemController::class, 'update'])->middleware('auth')->name('edit-cargo');
Route::get('/starship/{starship}/jobs', [ModalController::class, 'jobs'])->middleware('auth')->name('jobs');

//gameplay
Route::get('/starship/{starship}/damage/{damage}', [StarshipController::class, 'takeDamage'])->middleware('auth')->name('damage');
Route::get('/starship/{starship}/reset-damage', [StarshipController::class, 'resetDamage'])->middleware('auth')->name('reset');
Route::get('/system/{system}/repair/{quickFix}/{dice}', [SystemController::class, 'quickFix'])->middleware('auth')->name('quick-fix');
Route::get('/roll/{starship}', [ModalController::class, 'roll'])->middleware('auth');

//session management
Route::post('/register', [RegistrationController::class, 'register'])->middleware('guest');
Route::get('/register', [ModalController::class, 'register'])->middleware('guest');
Route::post('/login', [SessionsController::class, 'login'])->middleware('guest');
Route::get('/login', [ModalController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [SessionsController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/forgot-password', [ModalController::class, 'forgotPassword'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [SessionsController::class, 'forgotPassword'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [SessionsController::class, 'resetPasswordScreen'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [SessionsController::class, 'resetPassword'])->middleware('guest')->name('password.update');

//notifications
Route::get('/success/{message}', [ModalController::class, 'success'])->name('success');
Route::get('/get-notifications/{viewArchive}', [NotificationController::class, 'indexOrArchive'])->middleware('auth');
Route::get('/get-notifications-raw', [NotificationController::class, 'indexRaw'])->middleware('auth');
Route::get('/archive-notification/{notification}',[NotificationController::class, 'archive'])->middleware('auth');
Route::get('/read-notification/{notification}', [NotificationController::class, 'read'])->middleware('auth');

//mail preview
Route::get('/mail-preview', function () {
    return (new MailMessage())
        ->greeting('Hello!')
        ->line('This is a test of the email template.')
        ->action('You could click this button if you want.', 'https://www.google.com')
        ->line('Thank you for using our application!');
});
