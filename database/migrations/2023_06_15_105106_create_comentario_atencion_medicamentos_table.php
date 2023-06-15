<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\AtencionMedicamento;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comentario_atencion_medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('comentario');
            $table->foreignIdFor(AtencionMedicamento::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentario_atencion_medicamentos');
    }
};
