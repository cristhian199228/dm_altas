<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    public function atencionMedicamento()
    {
        return $this->belongsToMany(AtencionMedicamento::class, 'atencion_medicamentos_atencion');
    }
}
