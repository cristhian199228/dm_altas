<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estacion;
use Illuminate\Http\Request;

class EstacionController extends Controller
{
    //
    public function fetchEstaciones()
    {
        $estacion = Estacion::where('estado',1)->get();
        return $estacion;
    }
}
