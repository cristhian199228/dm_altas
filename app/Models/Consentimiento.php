<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consentimiento extends Model
{
    use HasFactory;
    protected $casts = [
        'fecha_inicio' => 'datetime:d/m/Y',
        'fecha_fin' => 'datetime:d/m/Y',
    ];

    protected $appends = ['fecha'];

    public function getFechaAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at);;
    }

    public function DescansoMedico(): BelongsTo
    {
        return $this->belongsTo(DescansoMedico::class);
    }
}
