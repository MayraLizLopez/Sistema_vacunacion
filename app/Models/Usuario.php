<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_user';
    protected $table = "usuarios";
    public $timestamps = false;
    protected $fillable = ['nombre', 'ape_pat', 'ape_mat', 'cargo', 'rol', 'id_insti', 'email', 'tel', 'password', 'activo'];
}
