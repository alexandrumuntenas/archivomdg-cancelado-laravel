<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function crearEvento (Request $request)
    {
        $evento = new Evento();
        $evento->nombre = $request->nombre;
        $evento->fecha = $request->fecha;
        $evento->hora = $request->hora;
        $evento->lugar = $request->lugar;
        $evento->participantes = $request->participantes;
        $evento->partituras = $request->partituras;
        $evento->save();
        return $evento;
    }
    public function editarEvento (Request $request)
    {
        $evento = Evento::find($request->id);
        $evento->nombre = $request->nombre;
        $evento->fecha = $request->fecha;
        $evento->hora = $request->hora;
        $evento->lugar = $request->lugar;
        $evento->participantes = $request->participantes;
        $evento->partituras = $request->partituras;
        $evento->save();
        return $evento;
    }
    public function eliminarEvento (Request $request)
    {
        $evento = Evento::find($request->id);
        $evento->delete();
        return $evento;
    }
}
