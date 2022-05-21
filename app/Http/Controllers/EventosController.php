<?php

namespace App\Http\Controllers;

use App\Models\Cuerda;
use App\Models\Evento;
use App\Models\Partitura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventosController extends Controller
{
    public function crearEvento(Request $request)
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
    public function editarEvento(Request $request)
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
    public function eliminarEvento(Request $request)
    {
        $evento = Evento::find($request->id);
        $evento->delete();
        return $evento;
    }
    public function obtenerPartituras(Request $request)
    {
        $partituras = explode(',', Evento::find($request->id)->partituras)->map(function ($partitura) {
            return Partitura::find($partitura);
        });

        // filtrar partituras por cuerda
        $partituras = array_filter($partituras, function ($value) {
            if (str_starts_with(explode('_', $value)[1], strtolower(Cuerda::all()->find(Auth::user()->cuerda)->nombre))) {
                return $value;
            } else {
                return false;
            }
        });

        return $partituras;
    }
}
