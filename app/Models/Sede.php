<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_sede';
    protected $table = "sedes";
    public $timestamps = false;
    protected $fillable = ['nombre', 'direccion', 'cupo', 'activo'];
}