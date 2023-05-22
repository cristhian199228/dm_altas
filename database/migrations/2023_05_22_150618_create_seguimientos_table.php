<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\AtencionDescanso;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            $table->longtext('comunicacion');
            $table->longtext('informacion_suministrada');
            $table->longtext('cie10');
            $table->datetime('fecha_inicio_sintomas');
            $table->integer('motivo_seguimiento');
            $table->foreignIdFor(AtencionDescanso::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};
