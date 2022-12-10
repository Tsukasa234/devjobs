<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\NotificacionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Ruta de inicio
Route::get('/', InicioController::class)->name('inicio');

Auth::routes(['verify' => true]);


//Rutas protegidas
Route::group(['middleware' => ['auth', 'verified']], function(){
    //Rutas Vacante
    Route::get('/vacantes', [VacanteController::class, 'index'])->name('vacantes.index');
    Route::get('/vacantes/create', [VacanteController::class, 'create'])->name('vacantes.create');
    Route::post('/vacantes', [VacanteController::class, 'store'])->name('vacantes.store');
    Route::delete('/vacantes/{vacante}', [VacanteController::class, 'destroy'])->name('vacantes.destroy');
    Route::get('/vacantes/edit/{vacante}', [VacanteController::class, 'edit'])->name('vacantes.edit');
    Route::put('/vacantes/{vacante}', [VacanteController::class, 'update'])->name('vacantes.update');

    //Subir Imagenes
    Route::post('/vacantes/imagen', [VacanteController::class, 'imagen'])->name('vacantes.imagen');
    Route::post('/vacantes/borrarimagen', [VacanteController::class, 'borrarimagen'])->name('vacantes.borrar');

    //Cambiar estado de la vacante
    Route::post('vacantes/{vacante}', [VacanteController::class, 'estado'])->name('vacantes.estado');

    //Notificaciones
    Route::get('/notificaciones', NotificacionController::class)->name('notificaciones');
});

//Rutas de candidato
Route::get('/candidatos/{id}', [CandidatoController::class, 'index'])->name('candidatos.index');
Route::post('/candidatos/store', [CandidatoController::class, 'store'])->name('candidatos.store');

//Categorias
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');

//Rutas de Busqueda
Route::get('/busqueda/buscar', [VacanteController::class, 'resultado'])->name('vacantes.resultado');
Route::post('/busqueda/buscar', [VacanteController::class, 'buscar'])->name('vacantes.buscar');

//Rutas vacantes sin proteccion del middleware
Route::get('/vacantes/{vacante}', [VacanteController::class, 'show'])->name('vacantes.show');


