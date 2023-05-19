<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $table = "pacientes";
    protected $primaryKey = "idpacientes";

    public function validacionReniec()
    {
        return $this->hasOne(ValidacionReniec::class, 'id_paciente', 'idpacientes');
    }
}
