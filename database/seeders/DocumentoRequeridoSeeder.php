<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentoRequerido;

class DocumentoRequeridoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //
        DocumentoRequerido::create(
            [
                'descripcion' => 'Certificado médico u odontológico (según corresponda) en especie valorada, sin borrones, tachadura ni enmendaduras',
                'estado' => '1',
            ],
        );
        DocumentoRequerido::create(
            [
                'descripcion' => 'Ticket o constancia de la atención médica',
                'estado' => '1',
            ],
        );
        DocumentoRequerido::create(
            [
                'descripcion' => 'Receta e indicaciones médicas',
                'estado' => '1',
            ],
        );
        DocumentoRequerido::create(
            [
                'descripcion' => 'Boleta de farmacia',
                'estado' => '1',
            ],
        );
        DocumentoRequerido::create(
            [
                'descripcion' => 'Recibo por honorarios del médico o boleta de venta de la clínica particular',
                'estado' => '1',
            ],
        );
        DocumentoRequerido::create(
            [
                'descripcion' => 'Orden de terapia (En caso de terapia)',
                'estado' => '1',
            ],
        );
        DocumentoRequerido::create(
            [
                'descripcion' => 'Cronograma de terapias (En caso de terapia)',
                'estado' => '1',
            ],
        );
        DocumentoRequerido::create(
            [
                'descripcion' => 'Orden de exámenes auxiliares: radiografía, resonancia, tomografía, laboratorio',
                'estado' => '1',
            ],
        );
        DocumentoRequerido::create(
            [
                'descripcion' => 'Informe de resultados de exámenes auxiliares',
                'estado' => '1',
            ],
        );
        DocumentoRequerido::create(
            [
                'descripcion' => 'Informe Médico(Si el DM es mayor a 20 días)',
                'estado' => '1',
            ],
        );
        DocumentoRequerido::create(
            [
                'descripcion' => 'Copia de DNI vigente del trabajador, ambas caras, legible',
                'estado' => '1',
            ],
        );
    }
}
