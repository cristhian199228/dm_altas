<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consentimiento;
use App\Models\DescansoMedico;
use App\Models\DocumentoRequerido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class DescansoMedicoController extends Controller
{
    //
    public function uploadDescansoMedico(Request $request)
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

        Storage::disk('ftp')->put("/DM_ALTAS/DM/$unique_name",  file_get_contents($file));

        //Guardar ruta en bd
        $foto = new DescansoMedico();
        $foto->atencion_descanso_id = $id_evidencia;
        $foto->ruta = $unique_name;
        $foto->save();

        //borrar foto de storage local
        /*   Storage::deleteDirectory($folder_dir); */

        return response([
            "message" => 'Foto subida correctamente'
        ]);
    }
    public function show(string $path)
    {
        //
        $file = '/DM_ALTAS/DM/' . $path;
        $file = Storage::disk('ftp')->get($file);

        return Image::make($file)->response();
    }
    public function fetchDocumentosRequeridos()
    {
        $documentos = DocumentoRequerido::All();
        return $documentos;
    }
    public function storeConsentimiento(Request $request)
    {
        $descanso = DescansoMedico::where('atencion_descanso_id', $request->atencion_id)->latest()->first();
        
        $consentimiento = new Consentimiento();
        $consentimiento->fecha_inicio =  $request->date[0];
        $consentimiento->fecha_fin = $request->date[1];
        $consentimiento->medico_emisor =  $request->nombre_medico;
        $consentimiento->motivo =  $request->motivo_descanso_medico;
        $consentimiento->descanso_medico_id = $descanso->id;
        $consentimiento->centro_medico =  $request->centro_medico;
        $consentimiento->establecimiento_intervencion_quirurgica = $request->centro_quirurgico;
        if ($request->firma) {
            $base64Image = trim($request->firma);
            $consentimiento->firma = $base64Image;
        }
        $consentimiento->declaracion_veracidad = 1;
        $consentimiento->estado = 1;
        $consentimiento->save();

        return response([
            "message" => 'Consentimiento grabado correctamente'
        ]);

        /* $foto = new DescansoMedico();
        $foto->atencion_descanso_id = $id_evidencia;
        $foto->ruta = $unique_name;
        $foto->save(); */
    }
    public function showConsentimientoPdf($id)
    {
       $consentimiento = Consentimiento::where('id',$id)
       ->with('DescansoMedico.AtencionDescanso.paciente')
       ->first();
        /*  $ficha = $ficha->load([
            'PcrPruebaMolecular.PcrEnvioMunoz',
            'PcrPruebaMolecular.envio',
            'usuario'
        ]);
 */
        //dd($ficha->Usuario);
        $pdf = \PDF::loadView('pdf.consentimiento', compact('consentimiento'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('consentimiento.pdf');
    }
}
