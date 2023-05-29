<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtencionDescanso extends Model
{
    use HasFactory;
    
    public function DescansosMedicos()
    {
        return $this->hasMany(DescansoMedico::class);
    }
    public function Consentimientos()
    {
        return $this->hasMany(Consentimiento::class);
    }
}
