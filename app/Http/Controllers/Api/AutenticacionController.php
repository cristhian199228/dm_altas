<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Paciente;
use App\Service\RegistroPacienteService;

class AutenticacionController extends Controller
{
    //
    public function loginLugarNacimiento(Request $request)
    {
        $data = $request->validate([
            "numero" => 'required',
            "fenac" => 'required',
            "nompadre" => 'required',
            'nommadre' => 'required',
            'coDepartamento' => 'required',
            'coProvincia' => 'required',
            'coDistrito' => 'required'
        ]);

        $payload = [
            "numero" => $data['numero'],
            "fenac" => Carbon::parse($data['fenac'])->format('d/m/Y'),
            "nompadre" => Str::upper($data['nompadre']),
            'nommadre' => Str::upper($data['nommadre']),
            "lugarnac" => "01",
            'ubigeonac' => "92-33-" . $data['coDepartamento'] . "-" .  $data['coProvincia']['coProvincia'] . "-" . $data['coDistrito'] . "-000",
            "user" => ''
        ];

        $pacienteLocal = Paciente::query()
            ->where('numero_documento', $data['numero'])
            ->where('fecha_nacimiento', $data['fenac'])
            ->whereHas('validacionReniec', function ($q) use ($data) {
                $q->where('nombre_padre', $data['nompadre']);
                $q->where('nombre_madre', $data['nommadre']);
                $q->where('departamento_nacimiento', $data['coDepartamento']);
                $q->where('provincia_nacimiento', $data['coProvincia']['coProvincia'],);
                $q->where('distrito_nacimiento', $data['coDistrito']);
            });


        if ($pacienteLocal->exists()) {
            $val = $pacienteLocal->first()->validacionReniec;
            $validoLocal = $payload['nompadre'] = $val->nombre_padre &&
                $payload['nommadre'] = $val->nombre_madre &&
                $data['coDepartamento'] = $val->departamento_nacimiento &&
                $data['coProvincia']['coProvincia'] = $val->provincia_nacimiento &&
                $data['coDistrito'] = $val->distrito_nacimiento;

            if (!$validoLocal) {
                return response([
                    "message" => "Algún dato ingresado no es correcto",
                ], 400);
            }

            return response([
                "message" => "Paciente validado correctamente!!",
                "data" => $pacienteLocal->first()
            ]);
        }

        $req = Http::withBody(http_build_query($payload), 'application/x-www-form-urlencoded')
            ->post("https://serviciosweb.reniec.gob.pe/aip/valida_dni.do");

        if ($req->failed()) {
            return response([
                "message" => 'Ocurrió un error con el servidor de validación'
            ], 500);
        }
        //dd($req->body());
        if (!str_contains($req->body(), $data['numero'])) {

            return response([
                "message" => strip_tags($req->body())
            ], 400);
        }

        $paciente = Paciente::firstWhere("numero_documento", $data['numero']);
        if (!$paciente) {
            $paciente_mediweb = Paciente::select('idpaciente', 'dni2', 'nombres', 'apellido_paterno', 'apellido_materno', 'idtipodocumento', 'telefono', 'fechanacimiento', 'sexo', 'idempresa')
                ->where('dni2',  $data['numero'])->first();
            $comprobante_mediweb = Comprobante::select('idsubcontrata')
                ->where('idpaciente', $paciente_mediweb->idpaciente)->orderBy('fecha', 'desc')->first();
            $empresa_mediweb = EmpresaMediweb::select('descripcion', 'ruc', 'nombrecomercial')
                ->where('idempresa',  $comprobante_mediweb->idsubcontrata)->first();
            $empresa = Empresa::where('ruc', $empresa_mediweb->ruc)->first();

            $paciente = new PacienteIsos();
            $paciente->estado = 1;
            $paciente->celular =  $paciente_mediweb->telefono;
            $paciente->nombres = $paciente_mediweb->nombres;
            $paciente->apellido_paterno = $paciente_mediweb->apellido_paterno;
            $paciente->apellido_materno = $paciente_mediweb->apellido_materno;
            $paciente->tipo_documento = $paciente_mediweb->idtipodocumento;
            $paciente->numero_documento = $paciente_mediweb->dni2;
            $paciente->fecha_nacimiento = $paciente_mediweb->fechanacimiento;
            $paciente->idempresa = $comprobante_mediweb->idsubcontrata;
            $paciente->save();
        }

        if (!$paciente->validacionReniec()->exists()) {
            $paciente->validacionReniec()->create([
                'nombre_padre' => $payload['nompadre'],
                'nombre_madre' => $payload['nommadre'],
                'departamento_nacimiento' => $data['coDepartamento'],
                'provincia_nacimiento' => $data['coProvincia']['coProvincia'],
                'distrito_nacimiento' => $data['coDistrito'],
            ]);
        }

        return response([
            "message" => "Paciente validado correctamente",
            "data" => $paciente
        ]);
    }
}
