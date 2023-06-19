<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $table = 'sedes';
    protected $primaryKey = 'idsedes';

    const SERVICIO_CV = [1, 2, 3, 6];
    const CLINICA_ISOS = 5;
    const SMCV = 4;

    public function Estacion()
    {
        return $this->hasMany('App\Estacion','idsede','idsedes'); 
    }
}
