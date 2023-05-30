<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\DescansoMedico;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consentimientos', function (Blueprint $table) {
            $table->id();
            $table->text('firma');
            $table->integer('estado');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('declaracion_veracidad');
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
            $table->foreignIdFor(DescansoMedico::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consentimientos');
    }
};
