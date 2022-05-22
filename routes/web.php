<?php

use App\Http\Controllers\EventosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(EventosController::class)->group(function () {
    Route::get('/eventos', 'obtenerEventos')->name('obtenerEventos')->middleware(['auth']);
    Route::get('/eventos/participa', 'obtenerEventosDelUsuario')->name('obtenerEventosDelUsuario')->middleware(['auth']);
    Route::get('/eventos/evento/{id?}', 'verEvento')->name('verEvento')->middleware(['auth']);
    Route::get('/eventos/ver', 'verEventos')->name('verEventos')->middleware(['auth']);
    Route::post('/eventos/crear', 'crearEvento')->name('crearEvento')->middleware(['auth']);
    Route::post('/eventos/editar', 'editarEvento')->name('editarEvento')->middleware(['auth']);
    Route::post('/eventos/eliminar', 'eliminarEvento')->name('eliminarEvento')->middleware(['auth']);
    Route::get('/eventos/archivos/{id}', 'obtenerArchivos')->name('archivos')->middleware(['auth']);
});

/*
Route::controller(FileManagerController::class)->group(function () {
    Route::get('/archivos/{path?}', 'index')->name('filemanager')->middleware(['auth']);
    Route::post('/archivos/subir', 'subirArchivo')->name('subirArchivo')->middleware(['auth']);
    Route::post('/archivos/eliminar', 'eliminarArchivo')->name('eliminarArchivo')->middleware(['auth']);
    Route::post('/archivos/renombrar', 'renombrarArchivo')->name('renombrarArchivo')->middleware(['auth']);
    Route::get('/archivos/descargar/{id?}/{path?}', 'descargarArchivo')->name('descargarArchivo')->middleware(['auth']);
});
*/