<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function index()
    {
        return Storage::allDirectories();
    }
    public function subirArchivo(Request $request)
    {
        $path = $request->file('archivo')->storeAs('archivos', $request->file('archivo')->getClientOriginalName());
        return $path;
    }
    public function renombrarArchivo(Request $request)
    {
        $path = $request->path;
        $nuevoNombre = $request->nuevoNombre;
        Storage::move($path, $nuevoNombre);
        return $path;
    }
    public function eliminarArchivo(Request $request)
    {
        $path = $request->path;
        Storage::delete($path);
        return $path;
    }
    public function crearDirectorio (Request $request)
    {
        $path = $request->path;
        Storage::makeDirectory($path);
        return $path;
    }
    public function renombrarDirectorio (Request $request)
    {
        $path = $request->path;
        $nuevoNombre = $request->nuevoNombre;
        Storage::move($path, $nuevoNombre);
        return $path;
    }
    public function eliminarDirectorio(Request $request)
    {
        $path = $request->path;
        Storage::deleteDirectory($path);
        return $path;
    }
    public function descargarArchivo(Request $request)
    {
        return Storage::download($request->id.'/'.$request->path);
    }
}
