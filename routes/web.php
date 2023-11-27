<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

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
    return view('welcome');
});

Route::get('/login', [UsuarioController::class, 'login'])->name('usuario.login');
Route::get('/home', [UsuarioController::class, 'home'])->name('usuario.home');
Route::get('/register', [UsuarioController::class, 'register'])->name('usuario.register');
Route::post('/save', [UsuarioController::class, 'save'])->name('usuario.save');