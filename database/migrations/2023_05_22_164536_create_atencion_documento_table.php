<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\DocumentoRequerido;
use  App\Models\AtencionDescanso;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atencion_documento', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AtencionDescanso::class)->constrained();
            $table->foreignIdFor(DocumentoRequerido::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atencion_documento');
    }
};
