<br>
<table>
    <thead>
        <tr>
            <th></th>
            <th height="100px" colspan="3"></th>
            <th style="text-align:center;" colspan="6">REPORTE DE DECLARACION DE MEDICAMENTOS</th>
        </tr>
        <tr>
            <th></th>
            <th style="text-align:center;">FECHA</th>
            <th style="text-align:center;">SEDE</th>
            <th style="text-align:center;">POSTA</th>
            <th style="text-align:center;">MEDICO ASIGNADO</th>
            <th style="text-align:center;">APELLIDOS Y NOMBRES</th>
            <th style="text-align:center;">REGISTRO</th>
            <th style="text-align:center;">NUMERO DOCUMENTO</th>
            <th style="text-align:center;">CELULAR</th>
            <th style="text-align:center;">MEDICAMENTOS</th>
            <th style="text-align:center;">ESTADO</th>
        </tr>
    </thead>
    <tbody>

        @foreach($medicamentos as $medicamento)
        <tr>
            <td></td>
            <td style=" border: 2px solid black;text-align:center;">{{ $medicamento->created_at ? $medicamento->created_at?:'' }}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $medicamento->estacion && $medicamento->estacion->sede && $medicamento->estacion->sede->descripcion ? $medicamento->estacion->sede->descripcion:'' }}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $medicamento->estacion && $medicamento->estacion->nombre_estacion ? $medicamento->estacion->nombre_estacion:'' }}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ strtoupper($medicamento->user && $medicamento->user->nombres) ? $medicamento->user->nombres:'' }} {{ strtoupper($medicamento->user && $medicamento->user->apellidos) ? $medicamento->user->apellidos:'' }}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $medicamento->paciente->full_name ? $medicamento->paciente->full_name :'' }}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $medicamento->paciente->nro_registro ? $medicamento->paciente->nro_registro:''}}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $medicamento->paciente->numero_documento ? $medicamento->paciente->numero_documento:''}}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $medicamento->paciente->celular ? $medicamento->paciente->celular:''}}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $medicamento->medicamentos_str ?  $medicamento->medicamentos_str:''}}</td>
            <td style=" border: 2px solid black;text-align:center;">{{ $medicamento->estado === 1 ? 'REVISADO':'EN REVISION' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
