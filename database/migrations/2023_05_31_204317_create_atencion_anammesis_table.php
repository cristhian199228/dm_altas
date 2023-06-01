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
        Schema::create('atencion_anammesis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AtencionDescanso::class)->constrained();
            $table->string('cie10', 20);
            $table->tinyInteger('principal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimiento_anammesis');
        Schema::dropIfExists('anammesis');
    }
};
