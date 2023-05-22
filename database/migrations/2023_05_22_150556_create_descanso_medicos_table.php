<?php

use App\Models\AtencionDescanso;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('descanso_medicos', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            $table->string('cie10');
            $table->string('numero_certificado');
            $table->string('medico_emisor');
            $table->string('cmp');
            $table->integer('motivo');
            $table->integer('centro_medico');
            $table->string('otros_centro_medico');
            $table->integer('producto_intervencion_quirurgica');
            $table->integer('establecimiento_intervencion_quirurgica');
            $table->string('otros_establecimiento_intervencion_quirurgica');
            $table->datetime('fecha_inicio_hospitalizacion');
            $table->datetime('fecha_fin_hospitalizacion');
            $table->foreignIdFor(AtencionDescanso::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descanso_medicos');
    }
};
