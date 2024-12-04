<?php

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

Route::get('/', function () {
    return view('main');
})->name('main');

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])
    ->name('register');
Route::get('/page/{key}', [\App\Http\Controllers\PageController::class, 'index'])
    ->name('page');


Route::group(['middleware' => ['check.link']], function () {
    Route::post('/activate_new_key/{key}', [\App\Http\Controllers\PageController::class, 'activateNewKey'])
        ->name('activate_new_key');
    Route::post('/deactivate_key/{key}', [\App\Http\Controllers\PageController::class, 'deactivateKey'])
        ->name('deactivate_key');
    Route::post('/game/{key}', [\App\Http\Controllers\PageController::class, 'createGame'])
        ->name('create_game');
    Route::post('/games/{key}', [\App\Http\Controllers\PageController::class, 'getGames'])
        ->name('get_games');
});
