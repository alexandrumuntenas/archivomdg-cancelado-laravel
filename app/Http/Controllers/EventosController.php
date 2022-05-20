<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function obtenerEventos() {
        $eventos = Evento::all();
        return response()->json($eventos);
    }
}
