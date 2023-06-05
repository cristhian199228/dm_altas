<?php

namespace Database\Factories;

use App\Models\AtencionDescanso;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<AtencionDescanso>
 */
class AtencionDescansoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "paciente_id" => Paciente::query()->inRandomOrder()->first()->idpacientes,
            "estado" => 0
        ];
    }
}
