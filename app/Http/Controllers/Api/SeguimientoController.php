<?php

namespace App\Http\Controllers\Api;

use App\Enums\DecisionMedica;
use App\Http\Controllers\Controller;
use App\Models\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Seguimiento::query()
            ->when(request('queryPaciente'), function ($query) {
                $query->whereHas('atencion.paciente', function ($q) {
                    $q->search(request('queryPaciente'));
                });
            })->when(request('fechaSeguimiento'), function ($query) {
                $query->whereDate('fecha_seguimiento', request('fechaSeguimiento'));
            })
            ->with('atencion.paciente', 'atencion.ultimoDescansoMedico')
            ->latest()
            ->paginate(request('itemsPerPage') ?? 10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Seguimiento $seguimiento)
    {
        return $seguimiento;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seguimiento $seguimiento)
    {
        $data = $request->validate([
            'comunicacion' => '',
            'informacion_suministrada' => '',
            'fecha_inicio_sintomas' => '',
            'motivo_seguimiento' => '',
            'motivo_seguimiento_otros' => '',
            'decision_medica' => '',
            'fecha_seguimiento' => '',
            'comentarios' => ''
        ]);
        $seguimiento->update($data);

        if ($data['decision_medica'] === 2) {
            $nuevo = new Seguimiento();
            $nuevo->atencion_descanso_id = $seguimiento->atencion_descanso_id;
            $nuevo->fecha_seguimiento = $data['fecha_seguimiento'];
            $nuevo->comunicacion = $data['comunicacion'];
            $nuevo->motivo_seguimiento = $data['motivo_seguimiento'];
            $nuevo->decision_medica = $data['decision_medica'];
            $nuevo->save();
        }

        $seguimiento->fresh();

        return $seguimiento;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seguimiento $seguimiento)
    {
        //
    }
}
