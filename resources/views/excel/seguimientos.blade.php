<br>
<table>
    <thead>
        <tr>
            <th></th>
            <th height="100px" colspan="3"></th>
            <th style="text-align:center;" colspan="8">REPORTE DE SEGUIMIENTO DESCANSOS MEDICOS</th>
        </tr>
        <tr>
            <th></th>
            <th style="text-align:center;">ENVIADO</th>
            <th style="text-align:center;">REGISTRO</th>
            <th style="text-align:center;">APELLIDOS Y NOMBRES</th>
            <th style="text-align:center;">DNI</th>
            <th style="text-align:center;">INICIO DM</th>
            <th style="text-align:center;">FIN DM</th>
            <th style="text-align:center;">PROXIMO SEGUIMIENTO</th>
            <th style="text-align:center;">PENDIENTE DE INFORMACION</th>
            <th style="text-align:center;">ALTA</th>
            <th style="text-align:center;">NO CONTESTA</th>
            <th style="text-align:center;">OBSERVACIONES</th>

        </tr>
    </thead>
    <tbody>

        @foreach($seguimientos as $seguimiento)
        <tr>
            <td></td>
            <td style=" border: 2px solid black;text-align:center;">{{ $seguimiento->created_at }}</td>
            <td></td>
            <td style=" border: 2px solid black;text-align:center;">{{ $seguimiento->atencion->paciente->nombres }} {{ $seguimiento->atencion->paciente->apellido_paterno }} {{ $seguimiento->atencion->paciente->apellido_materno }}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $seguimiento->atencion->paciente->numero_documento}}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $seguimiento->atencion->ultimoDescansoMedico->fecha_inicio}}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $seguimiento->atencion->ultimoDescansoMedico->fecha_fin}}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $seguimiento->atencion->ultimoDescansoMedico->fecha_fin}}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $seguimiento->decision_medica == 0 ? 'X': ' '}}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $seguimiento->decision_medica == 1 ? 'X': ' '}}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $seguimiento->decision_medica == 3 ? 'X': ' '}}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $seguimiento->comentarios}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
