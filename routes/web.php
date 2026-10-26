<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    CitaController,
    ClienteController,
    ServicioController,
    ProductoController
};
//use App\Http\Controllers\DashboardController;
//use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TrabajadoraController;
use App\Http\Controllers\CitumController;
//use App\Http\Controllers\ServicioController;
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
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Citas
    Route::resource('citas', CitaController::class);
    Route::get('/citas/agenda', [CitaController::class, 'agenda'])->name('citas.agenda');
    Route::post('/citas/{cita}/estado', [CitaController::class, 'cambiarEstado'])->name('citas.cambiar-estado');
    Route::get('/citas/horarios/disponibles', [CitaController::class, 'horariosDisponibles'])->name('citas.horarios-disponibles');
    
    // Clientes
    Route::resource('clientes', ClienteController::class);
    Route::get('/clientes/{cliente}/historial', [ClienteController::class, 'historial'])->name('clientes.historial');
    Route::get('/clientes/info', [ClienteController::class, 'info'])->name('clientes.info');
    
    // Servicios
    Route::resource('servicios', ServicioController::class);
    
    // Productos (Inventario)
    Route::resource('productos', ProductoController::class);
    Route::post('/productos/{producto}/ajustar-stock', [ProductoController::class, 'ajustarStock'])->name('productos.ajustar-stock');
});

//Route::resource("dashboard", DashboardController::class)-> middleware('auth');
//Route::resource("clientes", ClienteController::class)-> middleware('auth');
//Route::resource("trabajadoras", TrabajadoraController::class)-> middleware('auth');
//Route::resource("cita", CitumController::class)-> middleware('auth');
//Route::resource("servicios", ServicioController::class)-> middleware('auth');
//Route::resource("recibos", ReciboController::class)-> middleware('auth');
