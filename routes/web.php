<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TrabajadoraController;
use App\Http\Controllers\CitumController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ReciboController;



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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource("dashboard", DashboardController::class)-> middleware('auth');
Route::resource("clientes", ClienteController::class)-> middleware('auth');
Route::resource("trabajadoras", TrabajadoraController::class)-> middleware('auth');
Route::resource("cita", CitumController::class)-> middleware('auth');
Route::resource("servicios", ServicioController::class)-> middleware('auth');
Route::resource("recibos", ReciboController::class)-> middleware('auth');
