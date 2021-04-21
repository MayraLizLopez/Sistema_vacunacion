<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voluntario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_voluntario';
    protected $table = "voluntarios";
    public $timestamps = false;
    protected $fillable = ['id_insti', 'id_municipio', 'nombre', 'ape_pat', 'ape_mat', 'curp', 'email', 'tel', 'activo'];
}


