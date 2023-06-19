<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estacion extends Model
{
    use HasFactory;
    protected $table = 'estaciones';
    protected $primaryKey = 'idestaciones';

    public function Sede()
    {
        return $this->belongsTo('App\Sede','idsede');
    }
    
}
