<?php

namespace App\Service;

use App\PacienteIsos;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class RegistroPacienteService
{
    /**
     * @throws \Exception
     */
    public static function registrar($nroDoc)
    {
        $url = config('app.siscovid_url');
        $nroDocMinsa = preg_replace('/[^a-z0-9]+/i', '', $nroDoc);

        $paciente = null;

        for ($i = 1; $i <= 3; $i++) {
            $res = Http::withOptions([
                "headers" => [
                    "referer" => "$url/ficha/buscar/?tipo=0$i&numero=$nroDocMinsa",
                    "user-agent" => "Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1"
                ]
            ])->get("$url/ficha/api/buscar-documento/0$i/$nroDocMinsa/");
            //            dd($res->body());

            if (
                $res->successful()
                && isset($res->json()['datos']['data'])
                && count($res->json()['datos']['data']) > 0
            ) {
                $service = new MinsaService($res->json()['datos']['data']);
                $paciente = PacienteIsos::create([
                    'nombres' => $service->getValue('nombres'),
                    'apellido_paterno' => $service->getValue('apellido_paterno'),
                    'apellido_materno' => $service->getValue('apellido_materno'),
                    'fecha_nacimiento' => $service->getFechaNacimiento(),
                    'tipo_documento' => $i,
                    'numero_documento' => $nroDocMinsa,
                    'sexo' => $service->getSexo(),
                    'residencia_pais' => $service->getValue('residencia_pais'),
                    'residencia_departamento' => $service->getValue('residencia_departamento'),
                    'residencia_provincia' => $service->getValue('residencia_provincia'),
                    'residencia_distrito' => $service->getValue('residencia_distrito'),
                    'direccion' => $service->getValue('direccion'),
                    'celular' => $service->getValue('celular'),
                    'correo' => $service->getCorreo(),
                    'latitud' => $service->getValue('latitud'),
                    'longitud' => $service->getValue('longitud'),
                    'foto' => $service->getFoto(),
                    'estado' => $service->getEstado(),
                    'idempresa' => 258,
                    'uuid_minsa' => $service->getValue('uuid'),
                ]);
                break;
            }
        }
        if (!$paciente) {
            throw new \Exception("Error al registrar paciente");
        }
        return $paciente;
    }
    public static function registrarInvitado($data)
    {
       //dd($data);
        $url = config('app.siscovid_url');
        $nroDocMinsa = preg_replace('/[^a-z0-9]+/i', '', $data['numero_documento']);

        $paciente = null;

        for ($i = 1; $i <= 3; $i++) {
            $res = Http::withOptions([
                "headers" => [
                    "referer" => "$url/ficha/buscar/?tipo=0$i&numero=$nroDocMinsa",
                    "user-agent" => "Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1"
                ]
            ])->get("$url/ficha/api/buscar-documento/0$i/$nroDocMinsa/");
            //            dd($res->body());

            if (
                $res->successful()
                && isset($res->json()['datos']['data'])
                && count($res->json()['datos']['data']) > 0
            ) {
                //dd($data);
                $service = new MinsaService($res->json()['datos']['data']);
                $paciente = PacienteIsos::create([
                    'nombres' => $service->getValue('nombres'),
                    'apellido_paterno' => $service->getValue('apellido_paterno'),
                    'apellido_materno' => $service->getValue('apellido_materno'),
                    'fecha_nacimiento' => $service->getFechaNacimiento(),
                    'tipo_documento' => $i,
                    'numero_documento' => $nroDocMinsa,
                    'sexo' => $service->getSexo(),
                    'residencia_pais' => $service->getValue('residencia_pais'),
                    'residencia_departamento' => $service->getValue('residencia_departamento'),
                    'residencia_provincia' => $service->getValue('residencia_provincia'),
                    'residencia_distrito' => $service->getValue('residencia_distrito'),
                    'direccion' => $service->getValue('direccion'),
                    'celular' => $service->getValue('celular'),
                    'correo' => $service->getCorreo(),
                    'latitud' => $service->getValue('latitud'),
                    'longitud' => $service->getValue('longitud'),
                    'foto' => $service->getFoto(),
                    'estado' => $service->getEstado(),
                    'idempresa' => 258,
                    'uuid_minsa' => $service->getValue('uuid'),
                    'fecha_caducidad_dni' => $data['fecha_caducidad'],
                    'ubigeo_nacimiento' => $data['ubigeo'],
                ]);
                break;
            }
        }
        if (!$paciente) {
            throw new \Exception("Error al registrar paciente");
        }
        return $paciente;
    }
}
