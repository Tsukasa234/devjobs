@extends('layouts.app')

@section('navegacion')
    @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">
        Candidato: {{$vacante->titulo}}
    </h1>

    @if(count($vacante->candidato) > 0)
    <ul class="max-w-md mx-auto mt-10">
        @foreach($vacante->candidato as $candidato)
        <li class="p-5 border border-gray-400 mb-5">
            <p class="mb-4">Nombre: <span class="font-bold">{{$candidato->nombre}}</span></p>

            <p class="mb-4">Correo: <span class="font-bold">{{$candidato->email}}</span></p>

            <p class="mb-8">Fecha de Solicitud: <span class="font-bold">{{$candidato->created_at->diffForHumans()}}</span></p>

            <a class="bg-teal-500 p-3 inline-block text-xs font-bold uppercase text-white" href="/storage/cv/{{$candidato->cv}}">Ver Curriculum</a>
        </li>
        @endforeach
    </ul>
    @else
    <p class="text-center mt-5">No hay candidatos</p>
    @endif
@endsection
