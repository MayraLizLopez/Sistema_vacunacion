<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_municipio';
    protected $table = "municipios";
    public $timestamps = false;
    protected $fillable = ['nombre', 'activo'];

    public function voluntario(){
        return $this->hasMany('App\Voluntario', 'id_municipio');
    }

    public function institucion(){
        return $this->hasMany('App\Institucion', 'id_municipio');
    }
}
