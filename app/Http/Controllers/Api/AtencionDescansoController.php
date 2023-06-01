<?php

namespace App\Http\Controllers\Api;

use App\Enums\DecisionMedica;
use App\Http\Controllers\Controller;
use App\Models\AtencionDescanso;
use App\Models\Paciente;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtencionDescansoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atenciones = AtencionDescanso::query()
            ->with('paciente', 'ultimoDescansoMedico')
            ->paginate(15);

        return $atenciones;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        /*    $descanso = new DescansoMedico();
           $descanso->atencion_descanso_id  = $atencion->id;
           $descanso->save();
    */
        return response([
            "message" => "Atencion Creada Exitosamente",
            "data" => $atencion
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AtencionDescanso $atencionDescanso)
    {
        return $atencionDescanso->load('descansosMedicos', 'paciente', 'evidencias', 'seguimientos', 'anammesis.enfermedad');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AtencionDescanso $atencionDescanso)
    {
        //TODO: Agregar validacion paciente
        //Validar informacion
        $data = $request->validate([
            'paciente' => '',
            'anammesis' => '',
            'descansos' => ''
        ]);

        DB::transaction(function () use ($data, $atencionDescanso) {
            //Guardar paciente
            $atencionDescanso->paciente()->update([
                "celular" => $data['paciente']['celular'],
                "nro_registro" => $data['paciente']['nro_registro'],
            ]);
            $atencionDescanso->anammesis()->createMany($data['anammesis']);

        });

        $atencionDescanso->refresh();

        return $atencionDescanso;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AtencionDescanso $atencionDescanso)
    {
        $atencionDescanso->delete();

        return response()->noContent();
    }
}
