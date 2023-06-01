<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Anammesis extends Model
{
    use HasFactory;

    protected $table = "atencion_anammesis";
    protected $guarded = [];

    public function enfermedad(): BelongsTo {
        return $this->belongsTo(Enfermedad::class, 'cie10', 'cie10');
    }
}
