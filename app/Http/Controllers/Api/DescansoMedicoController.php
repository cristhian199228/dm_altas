<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DescansoMedico;
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
}
