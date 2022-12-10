<?php

namespace App\Http\Controllers;

use App\Models\Salario;
use App\Models\Vacante;
use App\Models\Categoria;
use App\Models\Ubicacion;
use App\Models\Experiencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $vacante = auth()->user()->vacantes;

        // $vacante = Vacante::where('user_id', auth()->user()->id)->take(3)->get();
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(6);

        // dd($vacante);

        return view('vacantes.index', compact('vacantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();

        return view('vacantes.create', compact('categorias', 'experiencias', 'ubicaciones', 'salarios'));
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
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'experiencia' => 'required',
            'ubicacion' => 'required',
            'salario' => 'required',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required'
        ]);

        //Almacenar los datos en la BD
        auth()->user()->vacantes()->create([
            'titulo' => $data['titulo'],
            'categoria_id' => $data['categoria'],
            'experiencia_id' => $data['experiencia'],
            'ubicacion_id' => $data['ubicacion'],
            'salario_id' => $data['salario'],
            'descripcion' => $data['descripcion'],
            'imagen' => $data['imagen'],
            'skills' => $data['skills']
        ]);

        return redirect()->action([VacanteController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        if($vacante->activa === 0) return abort(404);

        return view('vacantes.show', compact('vacante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {
        $this->authorize('view', $vacante);

        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();

        return view('vacantes.edit', compact('vacante', 'categorias', 'experiencias', 'ubicaciones', 'salarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante)
    {
        $this->authorize('update', $vacante);

        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'experiencia' => 'required',
            'ubicacion' => 'required',
            'salario' => 'required',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required'
        ]);

        //Almacenar los datos en la BD
        $vacante->titulo = $data['titulo'];
        $vacante->skills = $data['skills'];
        $vacante->imagen = $data['imagen'];
        $vacante->descripcion = $data['descripcion'];
        $vacante->categoria_id = $data['categoria'];
        $vacante->experiencia_id = $data['experiencia'];
        $vacante->ubicacion_id = $data['ubicacion'];
        $vacante->salario_id = $data['salario'];

        $vacante->save();

        return redirect()->action([VacanteController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacante $vacante)
    {
        $this->authorize('delete', $vacante);

        $vacante->delete();

        return response()->json(['mensaje' => 'Se elimino la vacante: ' . $vacante->titulo]);
    }

    //Campos Extras

    public function imagen(Request $request)
    {
        $imagen = $request->file('file');

        $nombreImagen = time() . '.' . $imagen->extension();

        $imagen->move(public_path('storage/vacantes'), $nombreImagen);

        return response()->json(['correcto' => $nombreImagen]);
    }

    public function borrarimagen(Request $request)
    {
        if($request->ajax())
        {
            $imagen = $request->get('imagen');

            if (File::exists('storage/vacantes/' . $imagen)) { //la clase file que hay que importar el facade tiene 2 metodos para verificar si una imagen existe
                File::delete('storage/vacantes/' . $imagen);
            }

            return response('imagen eliminada', 200);
        }
    }

    //Cambia el estado de una vacante
    public function estado(Request $request, Vacante $vacante)
    {
        //Leer nuevo dato y asignarlo
        $vacante->activa = $request->estado;
        //Guardarlo en la base de datos
        $vacante->save();

        return response()->json(['respuesta' => 'All ok']);
    }

    public function buscar(Request $request)
    {
        $data = request()->validate([
            'ubicacion' => 'required',
            'categoria' => 'required',
        ]);

        $categoria = $data['categoria'];
        $ubicacion = $data['ubicacion'];

        $vacantes = Vacante::latest()
                    ->where('categoria_id', $categoria)
                    ->Orwhere('ubicacion_id', $ubicacion)
                    ->where('activa', true)
                    ->get();

        // $vacante=Vacante::latest()->where([
        //     'categoria_id' => $categoria->id,
        //     'ubicacion_id' => $ubicacion->id,
        //     'activa' => true
        // ])->get();

        return view('buscar.index', compact('vacantes'));
    }

    public function resultado()
    {
        return 'hola';
    }
}
