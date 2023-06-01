<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consentimiento extends Model
{
    use HasFactory;
    public function DescansoMedico(): BelongsTo
    {
        return $this->belongsTo(DescansoMedico::class);
    }
}
