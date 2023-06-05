<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consentimiento;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DescansoMedico extends Model
{
    use HasFactory;
    protected $casts = [
        'fecha_inicio' => 'datetime:d/m/Y',
        'fecha_fin' => 'datetime:d/m/Y',
    ];
    protected $guarded = [];

    public function Consentimientos()
    {
        return $this->hasOne(Consentimiento::class);
    }

    public function AtencionDescanso(): BelongsTo
    {
        return $this->belongsTo(AtencionDescanso::class);
    }

    public function enfermedad(): BelongsTo {
        return $this->belongsTo(Enfermedad::class, 'cie10', 'cie10');
    }
}
