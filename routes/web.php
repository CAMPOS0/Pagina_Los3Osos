<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EmpleadoMenuController;
use App\Http\Controllers\EmpleadoOrdenController;

use App\Http\Controllers\ClienteEventoController;

use Illuminate\Http\Request;


Route::get('/user/invoice/{invoice}', function (Request $request, string $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId);
});


// Redirigir la raíz al login o dashboard directamente
Route::get('/', function () {
    return redirect('/dashboard');
});


Route::get('/cliente/cotizar', [ClienteEventoController::class, 'create'])->name('cliente.cotizar.form');
Route::post('/cliente/cotizar', [ClienteEventoController::class, 'store'])->name('cliente.cotizar');


// Dashboard protegido con auth y verificación
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas para usuarios logueados
Route::middleware(['auth'])->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Rutas protegidas para empleado
Route::middleware(['auth', 'role:empleado'])->group(function () {
    Route::get('/empleado/menu', [EmpleadoMenuController::class, 'index'])->name('empleado.menu');
    Route::post('/empleado/menu/orden', [EmpleadoMenuController::class, 'crearOrden'])->name('empleado.menu.crear-orden');
    Route::get('/empleado/orden', [EmpleadoOrdenController::class, 'index'])->name('empleado.orden.index');
    Route::get('/empleado/orden/{orden}/edit', [EmpleadoOrdenController::class, 'edit'])->name('empleado.orden.edit');
    Route::put('/empleado/orden/{orden}', [EmpleadoOrdenController::class, 'update'])->name('empleado.orden.update');
    Route::delete('/empleado/orden/{orden}', [EmpleadoOrdenController::class, 'destroy'])->name('empleado.orden.destroy');
});

// Rutas de Breeze (login, register, forgot-password, etc.)
require __DIR__.'/auth.php';

// Rutas protegidas para admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Usuarios (monolito en admin.usuario)
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    // Eventos (monolito en admin.evento)
    Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');
    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::put('/eventos/{evento}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/eventos/{evento}', [EventoController::class, 'destroy'])->name('eventos.destroy');
    Route::get('/eventos/{evento}/edit', [EventoController::class, 'edit'])->name('eventos.edit');

    // Servicios (monolito en admin.servicio)
    Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
    Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');
    Route::put('/servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
    Route::delete('/servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');
    Route::get('/servicios/{servicio}/edit', [ServicioController::class, 'edit'])->name('servicios.edit');

    // Menús (monolito en admin.menu)
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');

});


