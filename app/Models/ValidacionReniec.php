<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class ValidacionReniec extends Model
{
    use HasFactory;
    protected $table = "validacion_reniec_nacimiento";
    protected $primaryKey = "id_validacion";
    protected $guarded = [];

    /*protected $casts = [
        "nombre_padre" => 'encrypted',
        "nombre_madre" => 'encrypted',
        "departamento_nacimiento" => 'encrypted',
        "provincia_nacimiento" => 'encrypted',
        "distrito_nacimiento" => 'encrypted'
    ];*/
}
