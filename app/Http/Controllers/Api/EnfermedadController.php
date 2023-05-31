<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enfermedad;
use Illuminate\Http\Request;

class EnfermedadController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Enfermedad $enfermedad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enfermedad $enfermedad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enfermedad $enfermedad)
    {
        //
    }

    public function search() {
        return Enfermedad::query()
            ->where('descripcion', 'like', '%'. strtoupper(request('query')) . '%')
            ->orderBy('cie10')
            ->take(30)
            ->get();
    }
}
