<?php

namespace App\Http\Controllers\Api;

use App\Enums\DecisionMedica;
use App\Http\Controllers\Controller;
use App\Models\Anammesis;
use App\Models\AtencionDescanso;
use App\Models\Paciente;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

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
        return $atencionDescanso
            ->load(
                'descansosMedicos.enfermedad',
                'paciente.contactosEmergencia',
                'evidencias',
                'seguimientos',
                'anammesis.enfermedad'
            );
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

            'anammesis.*.id' => '',
            'anammesis.*.atencion_descanso_id' => '',
            'anammesis.*.cie10' => 'required',
            'anammesis.*.principal' => 'required',

            'descansos' => '',

            'seguimiento.id' => 'required',
            'seguimiento.comunicacion' => 'required',
            'seguimiento.informacion_suministrada' => 'required',
            'seguimiento.fecha_inicio_sintomas' => '',
            'seguimiento.motivo_seguimiento' => 'required',
            'seguimiento.motivo_seguimiento_otros' => '',
            'seguimiento.decision_medica' => 'required',
            'seguimiento.fecha_seguimiento' => '',
            'seguimiento.comentarios' => '',
           /*  'seguimiento.estado' => 'required', */
            'seguimiento.fecha_proximo_seguimiento' => '',

            'descansos_medicos.*.id' => '',
            'descansos_medicos.*.fecha_inicio' => '',
            'descansos_medicos.*.fecha_fin' => '',
            'descansos_medicos.*.ruta' => '',
            'descansos_medicos.*.cie10' => '',
            'descansos_medicos.*.numero_certificado' => '',
            'descansos_medicos.*.medico_emisor' => '',
            'descansos_medicos.*.cmp' => '',
            'descansos_medicos.*.motivo' => '',
            'descansos_medicos.*.centro_medico' => '',
            'descansos_medicos.*.otros_centro_medico' => '',
            'descansos_medicos.*.producto_intervencion_quirurgica' => '',
            'descansos_medicos.*.establecimiento_intervencion_quirurgica' => '',
            'descansos_medicos.*.otros_establecimiento_intervencion_quirurgica' => '',
            'descansos_medicos.*.fecha_inicio_hospitalizacion' => '',
            'descansos_medicos.*.fecha_fin_hospitalizacion' => '',
            'descansos_medicos.*.atencion_descanso_id' => '',
        ]);

        //return $data;

        if ($atencionDescanso->estado === 1) {
            return response([
                "message" => __('messages.error.tracing_discharge')
            ], Response::HTTP_BAD_REQUEST);
        }

        DB::transaction(function () use ($data, $atencionDescanso, $request) {
            $atencionDescanso->paciente()->update([
                "celular" => $data['paciente']['celular'],
                "nro_registro" => $data['paciente']['nro_registro'],
            ]);
            if (isset($data['anammesis']) && count($data['anammesis']) > 0) {
                $idsAnammesisPersistidas = $atencionDescanso->anammesis()->get()->pluck('id');
                $idsAnammesisRequest = collect($data['anammesis'])->pluck('id');
                $idsAnammesisEliminar = $idsAnammesisPersistidas->diff($idsAnammesisRequest);

                Anammesis::destroy($idsAnammesisEliminar);
                collect($data['anammesis'])
                    ->each(function ($am) use ($atencionDescanso) {
                        $atencionDescanso->anammesis()->updateOrCreate(["id" => $am['id']], $am);
                    });
            }
            if (isset($data['descansos_medicos']) && count($data['descansos_medicos']) > 0) {
                collect($data['descansos_medicos'])
                    ->each(function ($dm) use ($atencionDescanso) {
                        $atencionDescanso->descansosMedicos()->where('id', $dm['id'])
                            ->update($dm);
                    });
            }

            //DECISION MEDICA: SEGUIMIENTO
            if ($data['seguimiento']['decision_medica'] === 2) {
                $atencionDescanso->seguimientos()->create([
                    "fecha_seguimiento" => $data['seguimiento']['fecha_proximo_seguimiento']
                ]);
            }
            unset($data['seguimiento']['fecha_proximo_seguimiento']);
            $atencionDescanso->seguimientos()->where('id', $data['seguimiento']['id'])
                ->update($data['seguimiento']);
            $atencionDescanso->seguimientos()->where('id', $data['seguimiento']['id'])
                ->update(["user_id" => $request->user()->id]);

            //DECISION MEDICA: ALTA
            if ($data['seguimiento']['decision_medica'] === 1) {
                $atencionDescanso->update(["estado" => 1]);
            }
        });

        $atencionDescanso->refresh();
        //return  $request->user()->id;
        return response()->json([
            "data" => $atencionDescanso,
            "message" => __('messages.success.updated')
        ], Response::HTTP_OK);
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
