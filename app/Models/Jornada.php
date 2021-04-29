<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jornada';
    protected $table = "jornadas";
    public $timestamps = false;
    protected $fillable = ['folio', 'fecha_inicio', 'fecha_fin', 'mensaje', 'activo', 'fecha_creacion', 'fecha_edicion'];
}