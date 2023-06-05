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
            $table->longtext('comunicacion')->nullable();
            $table->longtext('informacion_suministrada')->nullable();
            $table->date('fecha_inicio_sintomas')->nullable();
            $table->tinyInteger('motivo_seguimiento')->nullable();
            $table->text('motivo_seguimiento_otros')->nullable();
            $table->tinyInteger('decision_medica')->nullable();
            $table->date('fecha_seguimiento')->nullable();
            $table->longText('comentarios')->nullable();
            $table->tinyInteger('estado');
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
