<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AtencionDescanso;
use App\Models\DescansoMedico;
use App\Models\Seguimiento;

class AtencionMedicaController extends Controller
{
    //
    public function fetchAtencion($id)
    {
        $atencion = AtencionDescanso::where('paciente_id', $id)
            ->with('DescansosMedicos.Consentimientos')
            ->with('evidencias')
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
        

        $seguimiento = new Seguimiento();
        $seguimiento->atencion_descanso_id  = $atencion->id;
        $seguimiento->fecha_seguimiento = date('Y-m-d');
        $seguimiento->estado  = 0;
        $seguimiento->save();
     /*    $descanso = new DescansoMedico();
        $descanso->atencion_descanso_id  = $atencion->id;
        $descanso->save();
 */
        return response([
            "message" => "Atencion Creada Exitosamente",
            "data" => $atencion
        ]);
    }
}
