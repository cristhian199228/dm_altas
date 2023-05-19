<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UbigeoController extends Controller
{
    //
    public function departamentosReniec(Request $request) {
        return Http::post("https://portaladminusuarios.reniec.gob.pe/duplicado/servicios/getDepartamentosNacim.do")
            ->json()['listDepartamento'];
    }

    public function provinciasReniec(Request $request) {
        return Http::post("https://portaladminusuarios.reniec.gob.pe/duplicado/servicios/getProvinciasNacim.do", [
            "coDepartamento" => $request->get('coDepartamento')
        ])->json()['listProvincia'];
    }

    public function distritosReniec(Request $request) {
        return Http::post("https://portaladminusuarios.reniec.gob.pe/duplicado/servicios/getDistritosNacim.do", [
            "coDepartamento" => $request->get('coDepartamento'),
            "coProvincia" => $request->get('coProvincia'),
        ])->json()['listDistrito'];
    }
}
