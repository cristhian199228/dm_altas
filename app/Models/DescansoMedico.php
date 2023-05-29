<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescansoMedico extends Model
{
    use HasFactory;
    protected $casts = [
        'fecha_inicio' => 'datetime:d/m/Y',
        'fecha_fin' => 'datetime:d/m/Y',
    ];
}
