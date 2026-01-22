<?php

namespace App\Models;

/**
 * Modèle Trajet
 */
class Trajet extends BaseModel
{
    /**
     * Retourne les trajets à venir avec des places disponibles
     */
    public static function getTrajetsDisponibles(): array
    {
        $pdo = self::getPDO();

        $sql = "
            SELECT *
            FROM trajets
            WHERE nb_places_disponibles > 0
              AND date_heure_depart > NOW()
            ORDER BY date_heure_depart ASC
        ";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}
