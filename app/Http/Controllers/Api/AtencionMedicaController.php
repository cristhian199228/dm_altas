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
        $atencion = AtencionDescanso::where('paciente_id', $id)
            ->with('DescansosMedicos')
            ->with('Consentimientos')
            ->get();
        return $atencion;
    }
    public function storeAtencion(Request $request)
    {
        $atencion_proceso = AtencionDescanso::where('paciente_id', $request->id_paciente)
            ->where('estado', 0)
            ->first();
        if ($atencion_proceso) {
            return response([
                "message" => "Existe una atencion en proceso"
            ]);
        }
        $atencion = new AtencionDescanso();
        $atencion->paciente_id  = $request['id_paciente'];
        $atencion->estado  = 0;
        $atencion->save();
        return response([
            "message" => "Atencion Creada Exitosamente",
            "data" => $atencion
        ]);
    }
}
