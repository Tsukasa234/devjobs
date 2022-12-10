<?php

namespace App\Http\Controllers;

use App\Models\Salario;
use App\Models\Vacante;
use App\Models\Ubicacion;
use App\Models\Experiencia;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $vacantes = Vacante::latest()->where('activa', true)->take(6)->get();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();
        $experiencias = Experiencia::all();

        return view('inicio.index', compact('vacantes','ubicaciones', 'salarios', 'experiencias'));
    }
}
