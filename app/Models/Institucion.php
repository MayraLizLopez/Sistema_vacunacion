<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_insti';
    protected $table = "instituciones";
    public $timestamps = false;
    protected $fillable = ['nombre', 'domicilio', 'nombre_enlace', 'cargo_enlace', 'id_municipio', 'email', 'tel', 'password', 'activo'];


    public function voluntario(){
        return $this->hasMany('App\Voluntario', 'id_insti');
    }
}
