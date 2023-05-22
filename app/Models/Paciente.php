<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Paciente extends Model
{
    use HasFactory;
    protected $table = "pacientes";
    protected $primaryKey = "idpacientes";
    protected $appends = ['edad'];

    public function validacionReniec()
    {
        return $this->hasOne(ValidacionReniec::class, 'id_paciente', 'idpacientes');
    }
    public function getEdadAttribute()
    {
        return \Carbon\Carbon::parse($this->fecha_nacimiento)->age;;
    }
}
