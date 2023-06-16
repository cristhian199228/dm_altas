<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactoEmergencia;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    //
    public function store(Request $request)
    {
        //return $request;

        $paciente = Paciente::with('contactosEmergencia')->find($request->id_paciente);
        $paciente->celular = $request->celular;
        $paciente->nro_registro = $request->nro_registro;
        $paciente->puesto = $request->puesto;
        $paciente->save();

        //$contacto
        if($request->celular_contacto && $request->nombre_contacto  || $request->parentesco){
        $contacto = ContactoEmergencia::firstOrNew(['paciente_id' =>  $request->id_paciente]); 
        $contacto->celular = $request->celular_contacto;
        $contacto->nombre_completo = $request->nombre_contacto;
        $contacto->parentesco= $request->parentesco_contacto; 
        $contacto->save();
        
        $paciente = Paciente::with('contactosEmergencia')->find($request->id_paciente);
        $paciente->celular = $request->celular;
        $paciente->nro_registro = $request->nro_registro;
        $paciente->puesto = $request->puesto;
        $paciente->save();
        return response([
            "message" => "Paciente Editado Correctamente",
            "paciente" => $paciente
        ]);
        }

        return response([
            "message" => "Paciente Editado Correctamente",
            "paciente" => $paciente
        ]);
    }
}
