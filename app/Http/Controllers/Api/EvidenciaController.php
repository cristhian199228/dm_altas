<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EvidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        $foto = new Evidencia();
        $foto->atencion_descanso_id = $id_evidencia;
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

    /**
     * Display the specified resource.
     */
    public function show(Evidencia $evidencia)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evidencia $evidencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evidencia $evidencia)
    {
        //use Ima
    }

    public function showImagen($ruta)
    {
        $file = '/DM_ALTAS/EV/' . $ruta;
        $file = Storage::disk('ftp')->get($file);

        return Image::make($file)->response();
    }
}
