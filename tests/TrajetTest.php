<?php

use PHPUnit\Framework\TestCase;
use App\Models\Trajet;

class TrajetTest extends TestCase
{
    public function testCreateTrajet()
    {
        $data = [
            'id_agence_depart' => 1,
            'id_agence_arrivee' => 2,
            'date_heure_depart' => '2026-01-01 10:00:00',
            'date_heure_arrivee' => '2026-01-01 12:00:00',
            'nombre_places_total' => 3
        ];

        Trajet::create($data, 1);

        $this->assertTrue(true);
    }
}