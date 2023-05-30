<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\DocumentoRequerido;
use App\Models\Consentimiento;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consentimiento_documento', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Consentimiento::class)->constrained();
            $table->foreignIdFor(DocumentoRequerido::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consentimiento_documento');
    }
};
