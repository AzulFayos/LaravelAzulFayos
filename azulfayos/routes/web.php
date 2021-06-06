<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\GeneroController;


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
    return view('auth.login');
});

Route::resource('persona', PersonaController::class)->middleware('auth');

Route::resource('genero', GeneroController::class)->middleware('auth');
Auth::routes(['reset'=>false]);

Route::get('/home', [PersonaController::class, 'index'])->name('home');

Route::prefix(['middleware' => 'auth'], function () {
    Route::get('/', [PersonaController::class, 'index'])->name('home');
});