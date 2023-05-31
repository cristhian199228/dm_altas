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
            $table->longtext('informacion_suministrada')->nullable();
            $table->datetime('fecha_inicio_sintomas')->nullable();
            $table->tinyInteger('motivo_seguimiento');
            $table->text('motivo_seguimiento_otros')->nullable();
            $table->tinyInteger('decision_medica');
            $table->date('fecha_seguimiento');
            $table->longText('comentarios')->nullable();
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
