<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventosController extends Controller
{
    public function obtenerEventos() {
        $eventos = Evento::all();
        return response()->json($eventos);
    }
    public function obtenerEvento($id) {
        $evento = Evento::find($id);
        return response()->json($evento);
    }
    public function crearEvento (Request $request) {
        $evento = new Evento();
        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->fecha = $request->fecha;
        $evento->save();
        return response()->json($evento);
    }
    public function editarEvento (Request $request) {
        $evento = Evento::find($request->id);
        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->fecha = $request->fecha;
        $evento->save();
        return response()->json($evento);
    }
    public function eliminarEvento (Request $request) {
        $evento = Evento::find($request->id);
        $evento->delete();
        return response()->json($evento);
    }
    public function verEvento (Request $request) {
        if ($request->id) {
            $evento = Evento::find($request->id);
            return view('eventos.verEvento', ['evento' => $evento]);
        } else {
            return redirect('/dashboard');
        }
    }
    public function obtenerArchivos ($id) {
        $evento = Storage::allFiles($id);
        return response()->json($evento);
    }
}
