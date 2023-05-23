<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DescansoMedico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Dompdf\Options;

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


        if ($request->file('file')->extension() != 'pdf') {

            $image = $request->file('file');

            // Ruta de almacenamiento temporal para la imagen
            $imagePath = $image->getPathname();
            // Crea una instancia de Dompdf con las opciones
            $options = new Options();
            $options->set('isRemoteEnabled', true); // Habilita la carga de imágenes remotas
            $dompdf = new Dompdf($options);

            // Genera el contenido HTML con la imagen
            $html = '<img src="' . $imagePath . '">';

            // Carga el contenido HTML en Dompdf
            $dompdf->loadHtml($html);

            // Renderiza el PDF
            $dompdf->render();

            // Genera el nombre del archivo PDF
            $filename = 'image.pdf';

            // Guarda el archivo PDF en la carpeta public
            $output = $dompdf->output();
            $storagePath = storage_path('app/public');
            $pdfPath = $storagePath . '/' . $filename;
            file_put_contents($pdfPath, $output);
        }
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
}
