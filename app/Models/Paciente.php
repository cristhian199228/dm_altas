<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

class Paciente extends Model
{
    use HasFactory;

    protected $table = "pacientes";
    protected $primaryKey = "idpacientes";
    protected $appends = ['edad', 'full_name'];
    protected $guarded = [];

    public function validacionReniec(): HasOne
    {
        return $this->hasOne(ValidacionReniec::class, 'id_paciente', 'idpacientes');
    }
    protected function edad(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->fecha_nacimiento)->age
        );
    }

    protected function fullName(): Attribute {
        return Attribute::make(
            get: fn () => implode(' ', array_filter([$this->nombres, $this->apellido_paterno, $this->apellido_materno]))
        );
    }
}
