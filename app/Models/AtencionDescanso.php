<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AtencionDescanso extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:d/m/Y'
    ];

    protected $guarded = [];

    public function descansosMedicos(): HasMany
    {
        return $this->hasMany(DescansoMedico::class)->latest('fecha_inicio');
    }

    public function ultimoDescansoMedico(): HasOne
    {
        return $this->hasOne(DescansoMedico::class)->latest('fecha_inicio');
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'idpacientes');
    }

    public function evidencias(): HasMany
    {
        return $this->hasMany(Evidencia::class);
    }

    public function seguimientos(): HasMany
    {
        return $this->hasMany(Seguimiento::class)->latest('fecha_seguimiento');
    }

    public function anammesis() : HasMany
    {
        return $this->hasMany(Anammesis::class);
    }
}
