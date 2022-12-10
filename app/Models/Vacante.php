<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacante extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'titulo',
        'imagen',
        'skills',
        'descripcion',
        'categoria_id',
        'experiencia_id',
        'ubicacion_id',
        'salario_id'
    ];

    //Relacion 1:1 de vacante a categorias
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }
    public function experiencia()
    {
        return $this->belongsTo(Experiencia::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Relacion 1:n de vacantes y candidatos
    public function candidato()
    {
        return $this->hasMany(Candidato::class);
    }
}
