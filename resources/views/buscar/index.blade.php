@extends('layouts.app')

@section('navegacion')
    @include('ui.adminnav')
    @include('ui.categoriasnav')
@endsection

@section('content')
    @if(count($vacantes) > 0)
    <div class="my-10 bg-gray-100 p-10 shadow">
        @include('ui.listadovacantes')
    </div>
    @else
    <p class="text-center text-gray-700">No hay vacantes que concuerden con la busqueda</p>
    @endif


@endsection
