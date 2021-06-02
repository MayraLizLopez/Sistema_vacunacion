<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnexoJornada extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_anexo_jornadas';
    protected $table = "anexo_jornadas";
    public $timestamps = false;
    protected $fillable = ['id_jornada', 'id_voluntario', 'nombre', 'anexo', 'tipo'];
}