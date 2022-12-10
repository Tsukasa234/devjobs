@extends('layouts.app')

@section('navegacion')
    @include('ui.adminnav')
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.min.css" integrity="sha512-zYqhQjtcNMt8/h4RJallhYRev/et7+k/HDyry20li5fWSJYSExP9O07Ung28MUuXDneIFg0f2/U3HJZWsTNAiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('navegacion')
    @include('ui.adminnav')
@endsection


@section('content')
<h1 class="text-2xl text-center mt-10">Editando {{$vacante->titulo}}</h1>

<form action="{{route('vacantes.update' , ['vacante' => $vacante->id])}}" method="POST" class="max-w-lg mx-auto my-10">
    @method('put')
    @csrf
    <div class="mb-5">
        <label for="titulo" class="block text-gray-700 text-sm mb-2">Titulo Vacante:</label>

        <input placeholder="Titulo de la vacante" id="titulo" value="{{$vacante->titulo}}" type="text" class="p-2 bg-gray-100 rounded form-input w-full @error('titulo') border border-red-500 @enderror" novalidate name="titulo">

        @error('titulo')
            <div class="bg-red-100 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <div class="mb-5">
        <label for="categoria" class="block text-gray-700 text-sm mb-2">Categoria</label>

        <select novalidate name="categoria" id="categoria" class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
            <option disabled selected>--Seleciona--</option>
            @foreach($categorias as $categoria)
                <option value="{{$categoria->id}}" {{$vacante->categoria_id == $categoria->id ? 'selected' : ''}}>{{$categoria->nombre}}</option>
            @endforeach
        </select>

        @error('categoria')
        <div class="bg-red-100 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="mb-5">
        <label for="experiencia" class="block text-gray-700 text-sm mb-2">Experiencia</label>

        <select name="experiencia" id="experiencia" class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
            <option disabled selected>--Seleciona--</option>
            @foreach($experiencias as $experiencia)
                <option value="{{$experiencia->id}}" {{$vacante->experiencia_id == $experiencia->id ? 'selected' : ''}}>{{$experiencia->nombre}}</option>
            @endforeach
        </select>

        @error('experiencia')
        <div class="bg-red-100 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="mb-5">
        <label for="ubicacion" class="block text-gray-700 text-sm mb-2">Ubicacion</label>

        <select name="ubicacion" id="ubicacion" class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
            <option disabled selected>--Seleciona--</option>
            @foreach($ubicaciones as $ubicacion)
                <option value="{{$ubicacion->id}}" {{$vacante->ubicacion_id == $ubicacion->id ? 'selected' : ''}}>{{$ubicacion->nombre}}</option>
            @endforeach
        </select>

        @error('ubicacion')
        <div class="bg-red-100 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="mb-5">
        <label for="salario" class="block text-gray-700 text-sm mb-2">Salario</label>

        <select name="salario" id="salario" class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
            <option disabled selected>--Seleciona--</option>
            @foreach($salarios as $salario)
                <option value="{{$salario->id}}" {{$vacante->salario_id == $salario->id ? 'selected' : ''}}>{{$salario->nombre}}</option>
            @endforeach
        </select>

        @error('ubicacion')
        <div class="bg-red-100 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="mb-5">
        <label for="descripcion" class="block text-gray-700 text-sm mb-2">Descripcion del puesto</label>

        <div class="editable p-3 bg-gray-100 rounded form-input w-full text-gray-700"></div>

        <input type="hidden" name="descripcion" id="descripcion" value="{{$vacante->descripcion}}">

        @error('descripcion')
        <div class="bg-red-100 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block">{{ $message }}</span>
        </div>
        @enderror
    </div>


    <div class="mb-5">
        <label for="imagen" class="block text-gray-700 text-sm mb-2">Imagen del puesto</label>

        <div id="dropzoneDevJobs" class="dropzone bg-gray-100 rounded"></div>

        <p id="error" class="p-3 text-gray-500 text-2xl text-center"></p>

        <input type="hidden" name="imagen" id="imagen" value="{{$vacante->imagen}}">

        @error('imagen')
        <div class="bg-red-100 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="mb-5">
        <label for="skills" class="block text-gray-700 text-sm mb-6">habilidades y conocimientos <span class="text-xs">(Elige al menos 3)</span></label>

        @php
            $skills = ['HTML5', 'CSS3', 'CSSGrid', 'Flexbox', 'JavaScript', 'jQuery', 'Node', 'Angular' , 'VueJS', 'ReactJS', 'React Hooks', 'Redux' , 'Apollo', 'GrahpQL', 'TypeScript', 'PHP', 'Laravel', 'Symfony', 'Python', 'Django', 'ORM', 'Sequelize', 'Mongoose', 'SQL', 'MVC', 'SASS', 'WordPress', 'Express', 'Deno', 'React Native', 'Flutter', 'MobX', 'C#', 'Ruby on Rails'];
        @endphp

        <lista-skills :skills="{{json_encode($skills)}}" :oldskills="{{json_encode($vacante->skills)}}"></lista-skills>

        @error('skills')
        <div class="bg-red-100 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <button type="submit" class="bg-teal-500 w-full hover:bg-teal-700 text-gray-100 font-bold p-3 focus:outline focus:shadow-outline uppercase">Editar Vacante</button>

</form>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js" integrity="sha512-5D/0tAVbq1D3ZAzbxOnvpLt7Jl/n8m/YGASscHTNYsBvTcJnrYNiDIJm6We0RPJCpFJWowOPNz9ZJx7Ei+yFiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    Dropzone.autoDiscover = false;

    document.addEventListener('DOMContentLoaded', ()=>{

        //Medium Editor
        const editor = new MediumEditor('.editable', {
            toolbar: {
                buttons: ['bold', 'italic', 'underline', 'quote', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', 'orderedlist', 'unorderedlist', 'h2', 'h3'],
                static: true,
                sticky: true
            },
            placeholder: {
                text: 'Informacion de la vacante'
            }
        });

        //Agregar al input:hidden lo que el usuario escribe en medium-editor


        editor.subscribe('editableInput', function(eventObj, editable){
            const contenido = editor.getContent();
            document.querySelector('#descripcion').value = contenido;
        });

        //Llena el editor con el editor del input:hidden
        editor.setContent(document.querySelector('#descripcion').value)

        //Dropzone
        const dropzoneDevJobs = new Dropzone('#dropzoneDevJobs', {
            url: '/vacantes/imagen',
            dictDefaultMessage: 'Sube aqui tu archivo',
            acceptedFiles:".png, .jpg, .jpeg, .webp, .jfif, .bpm",
            addRemoveLinks: true,
            dictRemoveFile: 'Remover Archivo',
            maxFiles: 1,

            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },

            init: function(){
                if(document.querySelector('#imagen').value.trim()){
                    const imagenPublicada = {};
                    imagenPublicada.size = 1234;
                    imagenPublicada.name = document.querySelector('#imagen').value;
                    imagenPublicada.nombreServidor = document.querySelector('#imagen').value

                    this.options.addedfile.call(this, imagenPublicada)
                    this.options.thumbnail.call(this, imagenPublicada, `/storage/vacantes/${imagenPublicada.name}`)

                    imagenPublicada.previewElement.classList.add('dz-success')
                    imagenPublicada.previewElement.classList.add('dz-complete')

                }
            },

            success: function(file, response){
                console.log(response.correcto);
                document.querySelector('#error').textContent = ""
                document.querySelector('#imagen').value = response.correcto

                //añadir al objeto de archvo el nombre del servidor
                file.nombreServidor = response.correcto;
            },
            error: function(file, response){
                console.log(response);
                document.querySelector('#error').textContent = "El formato no es valido"
            },
            maxfilesexceeded: function(file){
                if (this.files[1] != null) {
                    this.removeFile(this.files[0]);
                    this.addFile(file);
                }
            },
            removedfile: function(file, response){
                file.previewElement.parentNode.removeChild(file.previewElement);
                params = {
                    imagen: file.nombreServidor
                }

                axios.post('/vacantes/borrarimagen', params).then(respuesta => console.log(respuesta));
            }
        });
    })
</script>
@endsection
