<?php

namespace App\Http\Controllers;

use App\Models\Cuerda;
use App\Models\Evento;
use App\Models\Partitura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventosController extends Controller
{
    public function index()
    {
        return view('eventos.miseventos');
    }
    public function verEventos(Request $request)
    {
        return view('eventos.verEventos');
    }
    public function verEvento(Request $request)
    {
        return view('eventos.evento', ['eventoID' => $request->id]);
    }
    public function crearEvento(Request $request)
    {
        $evento = new Evento();
        $evento->nombre = $request->nombre;
        $evento->fecha = $request->fecha;
        $evento->hora = $request->hora;
        $evento->lugar = $request->lugar;
        $evento->participantes = $request->participantes;
        $evento->partituras = $request->partituras || '';
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
        $evento->partituras = $evento->partituras;
        $evento->save();
        return $evento;
    }
    public function eliminarEvento(Request $request)
    {
        return Evento::find($request->id)->delete();
    }
    public function obtenerPartituras(Request $request)
    {   
        foreach(explode(',', Evento::find($request->id)->partituras) as $partitura) {
            $partiturasDelEvento[] = Partitura::find($partitura);
        }

        $partiturasDelEvento = array_filter($partiturasDelEvento, 'strlen');

        $partiturasDelUsuario = [];

        foreach($partiturasDelEvento as $partitura) {
            if (Storage::exists($partitura->archivo . '_' . strtolower(Cuerda::all()->find(Auth::user()->cuerda)->nombre) . '.pdf')) {
                $partitura['archivo'] = $partitura->archivo . '_' . strtolower(Cuerda::all()->find(Auth::user()->cuerda)->nombre) . '.pdf';
                array_push($partiturasDelUsuario, $partitura);
            }
        }

        return $partiturasDelUsuario;
    }
    public function obtenerEvento (Request $request)
    {
        return Evento::find($request->id);
    }
    public function obtenerEventos ()
    {
        return Evento::all();
    }
    public function obtenerEventosDelUsuario ()
    {
        return Evento::where('fecha', '>=', date('Y-m-d'))->where('participantes', 'like', '%' . Auth::user()->id . '%')->orWhere('participantes', 'like', '@')->get();
    }
}
