<?php

namespace App\Http\Controllers;

use App\Models\Cuerda;
use Illuminate\Http\Request;

class CuerdasController extends Controller
{
    public function crearCuerda (Request $request)
    {
        $cuerda = new Cuerda();
        $cuerda->nombre = $request->nombre;
        $cuerda->save();
        return $cuerda;
    }
    public function editarCuerda (Request $request)
    {
        $cuerda = Cuerda::find($request->id);
        $cuerda->nombre = $request->nombre;
        $cuerda->save();
        return $cuerda;
    }
    public function eliminarCuerda (Request $request)
    {
        $cuerda = Cuerda::find($request->id);
        $cuerda->delete();
        return $cuerda;
    }
}
