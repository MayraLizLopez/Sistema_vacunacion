<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleJornada extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detalle_jornada';
    protected $table = "detalle_jornadas";
    public $timestamps = false;
    protected $fillable = ['id_jornada', 'id_voluntario', 'id_sede', 'uuid', 'horas', 'activo', 'eliminado'];
}