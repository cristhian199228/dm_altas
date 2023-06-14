<?php

namespace App\Models;

use App\Models\EvidenciaMedicamento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AtencionMedicamento extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:d/m/Y'
    ];
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'idpacientes');
    }
    public function evidencias(): HasMany
    {
        return $this->hasMany(EvidenciaMedicamento::class);
    }
    public function medicamento()
    {
        return $this->belongsToMany(Medicamento::class, 'atencion_medicamentos_atencion');
    }
}
