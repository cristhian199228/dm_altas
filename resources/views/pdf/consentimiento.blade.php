<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-size: 10px;
            font-family: Arial, 'sans-serif';
            line-height: 15px;
        }

        header {
            text-align: center;
            margin-top: 30px;
        }

        .transaction {
            float: right;
        }

        h3 {
            font-size: 13px;
        }

        .container {
            margin: 0 auto;
            width: 95%;
        }

        img {
            margin: 5px 10px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
            font-size: 11px;
        }

        .section-title {
            border-bottom: .5px solid black;
            border-top: .5px solid black;
            font-weight: bold;
            font-size: 11px;
        }

        ul {
            list-style: none;
        }

        .checkbox {
            border: .5px solid black;
            width: 25px;
            height: 10px;
            line-height: 10px;
            display: inline-block;
            text-align: center;
            margin-right: 2px;
        }

        .checkbox-large {
            border: .5px solid black;
            width: 120px;
            height: 10px;
            line-height: 10px;
            display: inline-block;
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .border-right {
            border-right: .5px solid black;
        }

        .mt-5 {
            margin-top: 5px;
        }

        .pl-5 {
            padding-left: 5px;
        }

        .col-1 {
            width: 25%;
        }

        .col-2 {
            width: 50%;
        }

        .col-3 {
            width: 75%;
        }

        .col-4 {
            width: 100%;
        }

        .pt-1 {
            padding-top: 1px;
        }

        .pt-5 {
            padding-top: 5px;
        }

        .pt-3 {
            padding-top: 3px;
        }

        .pl-17 {
            padding-left: 17px;
        }

        .pl-10 {
            padding-left: 10px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        td {
            margin: 0;
            padding: 0;
            vertical-align: top;
        }

        .w-33 {
            width: 33%;
        }

        .page {

            margin-top: 20px;
        }

    </style>
    <title>Ficha Investigación </title>
</head>

<body>

    <div class="container">
        <header>
            <h3>REGISTRO DE DESCANSO MEDICO - MEDICO NO AFILIADO AL PAMF</h3>
        </header>
        <div class="page">
            <table class="col-4 encabezado">
                <tr>
                    <td class="col-2">
                        FECHA : <strong>{{$consentimiento->created_at->format('d-m-Y');}}</strong>
                    </td>
                    <td class="col-2">
                        HORA :{{$consentimiento->created_at->format('h:i A');}}
                    </td>
                </tr>
            </table>

            <div>
                <p class="pl-5 mt-5 section-title">DATOS DEL TRABAJADOR</p>
            </div>
            <div class="pl-5">
                <table class="col-4 pt-1">
                    <tr>
                        <td class="col-2">Nombres y Apellidos : <strong>{{$consentimiento->descansomedico->atenciondescanso->paciente->fullName}}</strong></td>
                        <td class="col-2">Nro de Registro : <strong></strong></td>
                    </tr>
                    <tr>
                        <td class="col-2">Direccion Actual : <strong>{{$consentimiento->descansomedico->atenciondescanso->paciente['direccion']}}</strong></td>
                        <td class="col-2">Telefono FIjo : <strong></strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-2">Distrito : <strong></strong></td>
                        <td class="col-2">
                        </td>
                    </tr>
                    <tr>
                        <td class="col-2">Referencia : <strong></strong></td>
                        <td class="col-2">Celular : <strong>{{$consentimiento->descansomedico->atenciondescanso->paciente->celular}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-2">Correo Electronico : <strong>{{$consentimiento->descansomedico->atenciondescanso->paciente->correo}}</strong></td>
                        <td class="col-2">
                        </td>
                    </tr>
                    <tr>
                        <td class="col-2">Inicio de Descanso Medico : <strong>{{$consentimiento->fecha_inicio->format('d-m-Y')}}</strong></td>
                        <td class="col-2">Fin de Descanso Medico : <strong>{{$consentimiento->fecha_fin->format('d-m-Y')}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-2">Medico : <strong>{{$consentimiento->medico_emisor}}</strong></td>
                        <td class="col-2"> <strong></strong>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td class="col-2">10. Sexo:
                            <span><span class="checkbox"></span>Masculino </span>
                            <span><span class="checkbox"></span>Femenino </span>
                        </td>
                        <td class="col-2">11. Tipo de documento: <strong>
                              
                            </strong>
                            N° <strong></strong></td>
                    </tr>
                    <tr>
                        <td>12. Peso <span class="checkbox-large">gramos</span></td>
                        <td>13. Talla <span class="checkbox-large">metros</span></td>
                    </tr> --}}
                </table>
            </div>
        </div>
        <div>
            <p class="pl-5 mt-5 section-title">MOTIVO DEL DESCANSO MEDICO</p>
        </div>
        <div class="page">
            <div class="pl-5">
                <table class="col-8">
                    <tr>
                        <td class="col-2">
                            <p>Accidente de Trabajo</p>
                            <p>Accidente de Transito</p>
                            <p>Accidente Comun</p>
                            <p>Enfermedad </p>
                            <p>Maternidad</p>
                        </td>
                        <td class="col-3">
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['motivo'] === 1 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['motivo'] === 2 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['motivo'] === 3 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['motivo'] === 4 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['motivo'] === 5 ? 'X': '' }}</span></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <p class="pl-5 mt-5 section-title">CENTRO MEDICO DONDE OTORGARON EL DESCANSO</p>
        </div>
        <div class="page">
            <div class="pl-5">
                <table class="col-8">
                    <tr>
                        <td class="col-2">
                            <p>Clinica Arequipa</p>
                            <p>Clinica San Juan de Dios</p>
                            <p>Clinica Sanna</p>
                            <p>Clinica Monte Carmelo </p>
                            <p>Clinica Auna Valle Sur</p>
                            <p>Clinica San Pablo</p>
                            <p>Medico Particula afiliado al PAMF</p>
                            <p>International SOS</p>
                            <p>Medico Particula NO afiliado al PAMF</p>
                        </td>
                        <td class="col-3">
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['centro_medico'] === 1 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['centro_medico'] === 2 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['centro_medico'] === 3 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['centro_medico'] === 4 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['centro_medico'] === 5 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['centro_medico'] === 6 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['centro_medico'] === 7 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['centro_medico'] === 8 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['centro_medico'] === 9 ? 'X': '' }}</span></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <p class="pl-5 mt-5 section-title">HOSPITALIZACION</p>
        </div>
        <div class="page">
            <div class="pl-5">
                <table class="col-8">
                    <tr>
                        <td class="col-2">
                            El descanso medico es producto de una intervencion quirurgica
                            <p>SI</p>
                            <p>NO</p>
                        </td>
                        <td class="col-3">
                            <p> &nbsp;&nbsp;</p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['producto_intervencion_quirurgica'] === 1 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['producto_intervencion_quirurgica'] === null ? 'X': '' }}</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-2">
                            En que establecimiento de salud fue intervenido quirurgicamente
                            <p>Clinica Arequipa</p>
                            <p>Clinica San Juan de Dios</p>
                            <p>Clinica Sanna</p>
                            <p>Clinica Monte Carmelo</p>
                            <p>Clinica Auna Vallesur</p>
                            <p>Clinica San Pablo</p>
                        </td>
                        <td class="col-3">
                            <p> &nbsp;&nbsp;</p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['establecimiento_intervencion_quirurgica'] === 1 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['establecimiento_intervencion_quirurgica'] === 2 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['establecimiento_intervencion_quirurgica'] === 3 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['establecimiento_intervencion_quirurgica'] === 4 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['establecimiento_intervencion_quirurgica'] === 5 ? 'X': '' }}</span></p>
                            <p> &nbsp;&nbsp;<span class="checkbox">{{ $consentimiento['establecimiento_intervencion_quirurgica'] === 6 ? 'X': '' }}</span></p>
                        </td>
                    </tr>
                </table>
                <br>
                <br> Declaro que los datos tonsl1nados son verdaderos, estando la empresa facultada a realizar las verificaciones y aplicar, de ser el caso, las sanciones administrativas contempladas en las normas vigentes.
                <table class="col-8">
                    <tr>
                        <td class="col-2">
                        <p> &nbsp;&nbsp;</p>
                        </td>
                        <td class="col-4">
                            <p><img height="80" src="{{$consentimiento->firma}}" /></p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DNI : <strong>{{$consentimiento->descansomedico->atenciondescanso->paciente->numero_documento}}</strong>
                            </p>
                        </td>
                        <td class=" col-2">
                       <p> &nbsp;&nbsp;</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
