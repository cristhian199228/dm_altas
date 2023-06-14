<?php

use App\Models\AtencionMedicamento;
use App\Models\Medicamento;
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
        Schema::create('atencion_medicamentos_atencion', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AtencionMedicamento::class)->constrained();
            $table->foreignIdFor(Medicamento::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atencion_medicamentos_atencion');
    }
};
