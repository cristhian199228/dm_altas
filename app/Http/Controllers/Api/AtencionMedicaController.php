<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AtencionDescanso;

class AtencionMedicaController extends Controller
{
    //
    public function fetchAtencion($id)
    {
        $atencion = AtencionDescanso::where('paciente_id',$id)->get();
        return $atencion;
    }
}
