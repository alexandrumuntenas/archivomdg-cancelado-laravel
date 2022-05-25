<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\PartiturasController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect(route('misEventos'));
});

require __DIR__.'/auth.php';

Route::controller(EventosController::class)->group(function () {
    // RUTAS PÚBLICO (v)
    Route::get('/eventos/v', 'verEventos')->name('verEventos')->middleware(['auth']);
    Route::get('/eventos/v/me', 'misEventos')->name('verMisEventos')->middleware(['auth']);
    Route::get('/eventos/v/evento/{id?}', 'verEvento')->name('verEvento')->middleware(['auth']);
    Route::get('/eventos/v/evento/{id?}/partituras', 'verPartituras')->name('verPartituras')->middleware(['auth']);

    // API (d)
    Route::get('/eventos/d', 'obtenerEventos')->name('obtenerEventos')->middleware(['auth']);
    Route::get('/eventos/d/me', 'obtenerMisEventos')->name('obtenerMisEventos')->middleware(['auth']);
    Route::get('/eventos/d/evento/{id?}', 'obtenerEvento')->name('obtenerEvento')->middleware(['auth']);
    Route::get('/eventos/d/evento/{id?}/partituras', 'obtenerPartituras')->name('obtenerPartituras')->middleware(['auth']);

    // API CRUD (g)
    Route::post('/eventos/g/crear', 'crearEvento')->name('crearEvento')->middleware(['auth']);
    Route::post('/eventos/g/editar', 'editarEvento')->name('editarEvento')->middleware(['auth']);
    Route::post('/eventos/g/eliminar', 'eliminarEvento')->name('eliminarEvento')->middleware(['auth']);
});

Route::controller(PartiturasController::class)->group(function () {
    Route::get('/partituras/{path?}', 'index')->name('filemanager')->middleware(['auth']);
    Route::post('/partituras/subir', 'subirArchivo')->name('subirArchivo')->middleware(['auth']);
    Route::post('/partituras/eliminar', 'eliminarArchivo')->name('eliminarArchivo')->middleware(['auth']);
    Route::post('/partituras/renombrar', 'renombrarArchivo')->name('renombrarArchivo')->middleware(['auth']);
    Route::get('/partituras/descargar/{partitura?}/{cuerda?}', 'descargarPartitura')->name('descargarPartitura')->middleware(['auth']);
});
