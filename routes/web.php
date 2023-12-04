<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BoletoController;
use App\Http\Controllers\VueloController;

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

Route::get('/usuarios/login', [UsuarioController::class, 'login'])->name('usuario.login');
Route::post('usuarios/save', [UsuarioController::class, 'save'])->name('usuario.save');
Route::get('usuarios/register', [UsuarioController::class, 'register'])->name('usuario.register');
Route::get('usuarios/register/success', [UsuarioController::class, 'registerSuccess'])->name('usuario.register.success');
Route::post('/home/usuarios', [UsuarioController::class, 'home'])->name('usuario.home');
Route::get('/home/usuarios/{idUsuario}', [UsuarioController::class, 'homeScreen'])->name('usuario.homeScreen');

Route::get('/boletos/buy/{idUsuario}/{idVuelo}', [BoletoController::class, 'buy'])->name('boleto.buy');
Route::get('/boletos/buy/{idUsuario}/{idVuelo}/{numeroAsiento}/success', [BoletoController::class, 'buySuccess'])->name('boleto.success');
Route::get('/usuarios/{idUsuario}/vuelos', [UsuarioController::class, 'flights'])->name('usuario.flights');
Route::get('/usuarios/{idUsuario}/account', [UsuarioController::class, 'account'])->name('usuario.account');
Route::get('/usuarios/{idUsuario}/account/delete', [UsuarioController::class, 'delete'])->name('usuario.delete');
Route::get('/usuarios/{idUsuario}/account/delete/success', [UsuarioController::class, 'deleteSuccess'])->name('usuario.deleteSuccess');
Route::get('/usuarios/{idUsuario}/account/update', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::get('/usuarios/{idUsuario}/account/update/success', [UsuarioController::class, 'updateSuccess'])->name('usuario.updateSuccess');
Route::post('{idUsuario}/vuelo/ciudades', [VueloController::class, 'cityFlights'])->name('vuelo.ciudades');