<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seguimiento extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function atencion() : BelongsTo
    {
        return $this->belongsTo(AtencionDescanso::class, 'atencion_descanso_id', 'id');
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
