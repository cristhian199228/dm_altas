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
            $table->datetime('fecha_inicio')->nullable();
            $table->datetime('fecha_fin')->nullable();
            $table->string('ruta');
            $table->string('cie10')->nullable();
            $table->string('numero_certificado')->nullable();
            $table->string('medico_emisor')->nullable();
            $table->string('cmp')->nullable();
            $table->integer('motivo')->nullable();
            $table->integer('centro_medico')->nullable();
            $table->string('otros_centro_medico')->nullable();
            $table->integer('producto_intervencion_quirurgica')->nullable();
            $table->integer('establecimiento_intervencion_quirurgica')->nullable();
            $table->string('otros_establecimiento_intervencion_quirurgica')->nullable();
            $table->datetime('fecha_inicio_hospitalizacion')->nullable();
            $table->datetime('fecha_fin_hospitalizacion')->nullable();
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
