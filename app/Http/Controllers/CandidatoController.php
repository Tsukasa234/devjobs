<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Models\Candidato;
use Illuminate\Http\Request;
use App\Notifications\NuevoCandidato;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //obtener el id actual de la vacante
        // dd($request->route('id'));

        $id_vacante = $request->route('id');

        //obtener los candidatos y la vacante
        $vacante = Vacante::findOrFail($id_vacante);

        $this->authorize('view', $vacante);

        // dd($vacante);

        return view('candidatos.index', compact('vacante'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'email' => 'required',
            'cv' => 'required|mimes:pdf|max:1000',
            'vacante_id' => 'required'
        ]);

        //almacenar archivo PDF
        if ($request->file('cv')) {
            $archivo = $request->file('cv');
            $nombreArchivo = time() . "." . $request->file('cv')->extension();
            $ubicacion = public_path('/storage/cv');
            $archivo->move($ubicacion, $nombreArchivo);
        }

        $vacante = Vacante::find($data['vacante_id']);

        $vacante->candidato()->create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'cv' => $nombreArchivo,
        ]);

        $reclutador = $vacante->usuario;
        $reclutador->notify(new NuevoCandidato($vacante->titulo, $vacante->id));


        //Primera forma de agregar datos a la BD
        // $candidato = new Candidato();
        // $candidato->nombre = $data['nombre'];
        // $candidato->email = $data['email'];
        // $candidato->cv = "hola.pdf";
        // $candidato->vacante_id = $data['vacante_id'];


        //Segunda forma de agregar datos a la BD
        // $candidato = new Candidato($data);
        // $candidato->cv = "hola.pdf";

        //Tercera forma de agregar datos a la BD
        // $candidato = new Candidato();
        // $candidato->fill($data);
        // $candidato->cv = "hola.pdf";

        // $candidato->save();

        return back()->with('estado', 'Tus datos se han enviado correctamente!!, suerte');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato)
    {
        //
    }
}
