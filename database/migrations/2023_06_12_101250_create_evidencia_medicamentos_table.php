<?php

use App\Models\AtencionMedicamento;
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
        Schema::create('evidencia_medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('ruta');
            $table->string('tipo_archivo');
            $table->integer('estado');
            $table->foreignIdFor(AtencionMedicamento::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidencia_medicamentos');
    }
};
