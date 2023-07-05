<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AtencionMedicamento;
use App\Models\EvidenciaMedicamento;
use App\Models\Medicamento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SeguimientoExport;
use App\Exports\AtencionMedicamentoExport;
use App\Models\Seguimiento;

class AtencionMedicamentoController extends Controller
{
    //
    public function fetchAtencion($id)
    {
        $medicamento = AtencionMedicamento::where('paciente_id', $id)
            ->with('evidencias')
            ->with('paciente')
            ->get();
        return $medicamento;
    }

    public function fetchAtencionPorId($id)
    {
        $medicamento = AtencionMedicamento::where('id', $id)
            ->with('evidencias')
            ->with('paciente.contactosEmergencia')
            ->with('medicamento')
            ->first();
        return $medicamento;
    }

    public function fetchAtencionMedicamento()
    {
        return AtencionMedicamento::query()
            ->with('evidencias')
            ->with('paciente')
            ->with('medicamento')
            ->latest()
            ->paginate(request('itemsPerPage') ?? 5);
    }

    public function uploadEvidencia(Request $request)
    {
        $request->validate([
            'id_atencion' => 'required',
            'file' => 'required'
        ]);

        //asignar nombre unico al archivo

        $id_evidencia = $request->id_atencion;
        $file = $request->file('file');
        $fileName = Str::random(10);
        $unique_name = md5($fileName . time()) . '.' . $file->extension();

        //guardar foto en storage local

        Storage::disk('ftp')->put("/DM_ALTAS/EV/$unique_name",  file_get_contents($file));

        //Guardar ruta en bd
        $foto = new EvidenciaMedicamento();
        $foto->atencion_medicamento_id = $id_evidencia;
        $foto->tipo_archivo = 'jpg';
        $foto->estado = 1;
        $foto->ruta = $unique_name;
        $foto->save();

        //borrar foto de storage local
        /*   Storage::deleteDirectory($folder_dir); */

        return response([
            "message" => 'Foto subida correctamente'
        ]);
    }
    public function storeMedicamento(Request $request)
    {
        $atencion_proceso = AtencionMedicamento::where('paciente_id', $request->id_paciente)
            ->where('estado', 0)
            ->first();
        if ($atencion_proceso) {
            return response([
                "message" => "Existe una Declaración en Proceso"
            ]);
        }

        $atencion = new AtencionMedicamento();
        $atencion->paciente_id  = $request['id_paciente'];
        $atencion->estado  = 0;
        $atencion->save();

        return response([
            "message" => "Declaracion Creada Exitosamente",
            "data" => $atencion
        ]);
    }
    public function searchMedicamento(Request $request)
    {
        $medicamento = Medicamento::where('descripcion', 'LIKE', "%{$request->valor}%")->get();
        return $medicamento;
    }
    public function storeMedicamentoAtencion(Request $request)
    {
        $atencion = AtencionMedicamento::find($request->id_atencion);
        if (!is_null($request->id_medicamento)) $atencion->medicamento()->attach($request->id_medicamento);
        if (is_null($request->id_medicamento)) {
            $medicamento = new Medicamento();
            $medicamento->descripcion = $request->medicamento_string;
            $medicamento->reportable = 0;
            $medicamento->save();
            $atencion->medicamento()->attach($medicamento->id);
        }

        return response([
            "message" => "Atencion Creada Exitosamente"
        ]);
    }
    public function fetchTablaMedicamentos($id)
    {
        $atencion =  AtencionMedicamento::find($id);
        $medicamentos  = $atencion->medicamento;
        return $medicamentos;
    }
    public function eliminarMedicamento(Request $request)
    {
        $atencion = AtencionMedicamento::find($request->id_atencion);
        $atencion->medicamento()->detach($request->id_medicamento);

        return response([
            "message" => "Medicamento Eliminado Exitosamente"
        ]);
    }
    public function cambiarTieneReceta(Request $request)
    {
        $atencion = AtencionMedicamento::find($request->id_atencion);
        $atencion->medicamento()->updateExistingPivot($request->id_medicamento, ['tiene_receta' => $request->tiene_receta]);
    }
    public function export()
    {
        $medicamento = AtencionMedicamento::with('evidencias')
            ->with('paciente')
            ->with('medicamento')
            ->with('Estacion.Sede')
            ->with('user')
            ->get();
        foreach ($medicamento as $medicamentos) {
            $arr = [];
            foreach ($medicamentos->medicamento as $med) {
                array_push($arr, $med->descripcion . '(' . ($med->reportable ? 'REPORTABLE' : 'NO REPORTABLE') . ',' . ($med->pivot->tiene_receta ? 'CON RECETA' : 'SIN RECETA') . ')');
            }
            $medicamentos->medicamentos_str = implode(", ", $arr);
        }
        //dd($medicamento);
        return Excel::download(new AtencionMedicamentoExport($medicamento), 'medicamentos.xlsx');
    }
    public function saveCalificacion(Request $request)
    {
        //return $request->declaracion_medicamento;
        $atencion = AtencionMedicamento::find($request->id_atencion);
        $atencion->estado = $request->declaracion_medicamento['estado'];
        $atencion->aptitud =  $request->declaracion_medicamento['aptitud'];
        $atencion->observaciones =  $request->declaracion_medicamento['observaciones'];
        $atencion->estacion_id =  $request->declaracion_medicamento['estacion_id'];
        $atencion->closed_at = date('Y-m-d H:i:s');
        $atencion->user_id = $request->user()->id;
        $atencion->save();
        return $atencion;
    }
}
