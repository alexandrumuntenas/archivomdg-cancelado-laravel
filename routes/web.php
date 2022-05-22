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
    return redirect('/miseventos');
});

require __DIR__.'/auth.php';

Route::controller(EventosController::class)->group(function () {
    Route::get('/eventos/miseventos', 'index')->name('misEventos')->middleware(['auth']);
    Route::get('/eventos/ver', 'verEventos')->name('verEventos')->middleware(['auth']);
    Route::get('/eventos/evento/{id?}', 'verEvento')->name('verEvento')->middleware(['auth']);

    // API
    Route::get('/eventos/detalles/{id?}', 'obtenerEvento')->name('obtenerEvento')->middleware(['auth']);
    Route::get('/eventos/detalles/{id?}/partituras', 'obtenerPartituras')->name('obtenerPartituras')->middleware(['auth']);
    Route::get('/eventos/todos', 'obtenerEventos')->name('obtenerEventos')->middleware(['auth']);
    Route::get('/eventos/participa', 'obtenerEventosDelUsuario')->name('obtenerEventosDelUsuario')->middleware(['auth']);
    Route::post('/eventos/crear', 'crearEvento')->name('crearEvento')->middleware(['auth']);
    Route::post('/eventos/editar', 'editarEvento')->name('editarEvento')->middleware(['auth']);
    Route::post('/eventos/eliminar', 'eliminarEvento')->name('eliminarEvento')->middleware(['auth']);
});

Route::controller(PartiturasController::class)->group(function () {
    Route::get('/partituras/{path?}', 'index')->name('filemanager')->middleware(['auth']);
    Route::post('/partituras/subir', 'subirArchivo')->name('subirArchivo')->middleware(['auth']);
    Route::post('/partituras/eliminar', 'eliminarArchivo')->name('eliminarArchivo')->middleware(['auth']);
    Route::post('/partituras/renombrar', 'renombrarArchivo')->name('renombrarArchivo')->middleware(['auth']);
    Route::get('/partituras/descargar/{partitura?}/{cuerda?}', 'descargarPartitura')->name('descargarPartitura')->middleware(['auth']);
});
