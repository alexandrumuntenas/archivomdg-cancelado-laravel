<?php

namespace App\Http\Controllers;

use App\Models\Partitura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartiturasController extends Controller
{
    public function subirPartitura (Request $request)
    {
        $partitura = new Partitura();
        $partitura->nombre = $request->nombre;
        $partitura->archivo = $request->file('archivo')->storeAs('partituras', $request->file('archivo')->getClientOriginalName());
        $partitura->save();
        return $partitura;
    }
    public function editarPartitura (Request $request)
    {
        $partitura = Partitura::find($request->id);
        $partitura->nombre = $request->nombre;
        $partitura->archivo = $request->file('archivo')->storeAs('partituras', $request->file('archivo')->getClientOriginalName());
        $partitura->save();
        return $partitura;
    }
    public function eliminarPartitura (Request $request)
    {
        $partitura = Partitura::find($request->id);
        $partitura->delete();
        return $partitura;
    }
}
