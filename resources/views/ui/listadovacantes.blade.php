<ul class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
    @foreach($vacantes as $vacante)
    <li class="p-10 border border-gray-300 shadow">
        <h2 class="text-2xl font-bold text-gray-700">Titulo: <span class="font-bold">{{$vacante->titulo}}</span></h2>

        <p class="block text-gray-700 font-normal my-2">Categoria: <span class="font-bold">{{$vacante->categoria->nombre}}</span></p>

        <p class="block text-gray-700 font-normal my-2">Experiencia: <span class="font-bold">{{$vacante->experiencia->nombre}}</span></p>

        <p class="block text-gray-700 font-normal my-2">Salario: <span class="font-bold">{{$vacante->salario->nombre}}</span></p>

        <p class="block text-gray-700 font-normal my-2">Ubicacion: <span class="font-bold">{{$vacante->ubicacion->nombre}}</span></p>

        <p class="block text-gray-700 font-normal my-2">Fecha de creacion: <span class="font-bold">{{$vacante->created_at->diffForHumans()}}</span></p>

        <a class="mt-2 bg-teal-500 py-2 px-4 inline-block font-bold uppercase text-gray-100 rounded text-sm" href="{{route('vacantes.show', ['vacante' => $vacante->id])}}">Ver Vacante</a>
    </li>
    @endforeach
</ul>
