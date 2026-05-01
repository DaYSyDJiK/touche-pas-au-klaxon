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
    SELECT 
        t.id_trajet,
        a1.ville AS agence_depart,
        a2.ville AS agence_arrivee,
        t.date_heure_depart,
        t.nombre_places_disponibles
    FROM trajet t
    JOIN agence a1 ON t.id_agence_depart = a1.id_agence
    JOIN agence a2 ON t.id_agence_arrivee = a2.id_agence
    WHERE t.nombre_places_disponibles > 0
      AND t.date_heure_depart > NOW()
    ORDER BY t.date_heure_depart ASC
";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}
