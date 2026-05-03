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
        t.date_heure_arrivee,
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

    public static function create(array $data, int $idUtilisateur): void
    {
        $pdo = self::getPDO();

        $sql = "
        INSERT INTO trajet (
            id_utilisateur,
            id_agence_depart,
            id_agence_arrivee,
            date_heure_depart,
            date_heure_arrivee,
            nombre_places_total,
            nombre_places_disponibles
        ) VALUES (
            :id_utilisateur,
            :id_agence_depart,
            :id_agence_arrivee,
            :date_heure_depart,
            :date_heure_arrivee,
            :nombre_places_total,
            :nombre_places_disponibles
        )
    ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id_utilisateur' => $idUtilisateur,
            ':id_agence_depart' => $data['id_agence_depart'],
            ':id_agence_arrivee' => $data['id_agence_arrivee'],
            ':date_heure_depart' => $data['date_heure_depart'],
            ':date_heure_arrivee' => $data['date_heure_arrivee'],
            ':nombre_places_total' => $data['nombre_places_total'],
            ':nombre_places_disponibles' => $data['nombre_places_total']
        ]);
    }

    public static function getAll(): array
    {
        $pdo = self::getPDO();

        $sql = "SELECT t.id_trajet,
        a1.ville AS agence_depart,
        a2.ville AS agence_arrivee,
        t.date_heure_depart,
        t.date_heure_arrivee,
        t.nombre_places_total,
        t.nombre_places_disponibles 
        FROM trajet t
        JOIN agence a1 ON t.id_agence_depart = a1.id_agence
        JOIN agence a2 ON t.id_agence_arrivee = a2.id_agence
        ORDER BY t.date_heure_depart DESC";

        $stmt = $pdo->query($sql); // Pas de paramètres, on peut utiliser query() pour moins de lignes de code

        return $stmt->fetchAll();
    }


    public static function findById(int $id): ?array
    {
        $pdo = self::getPDO();

        $sql = "SELECT * FROM trajet WHERE id_trajet = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $trajet = $stmt->fetch();

        return $trajet ?: null;
    }


    public static function delete(int $id): void
    {
        $pdo = self::getPDO();

        $sql = "DELETE FROM trajet WHERE id_trajet = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }


    public static function update(int $id, array $data): void
    {
        $pdo = self::getPDO();

        $sql = "
        UPDATE trajet SET 
            id_agence_depart = :id_agence_depart,
            id_agence_arrivee = :id_agence_arrivee,
            date_heure_depart = :date_heure_depart,
            date_heure_arrivee = :date_heure_arrivee,
            nombre_places_total = :nombre_places_total,
            nombre_places_disponibles = :nombre_places_disponibles
        WHERE id_trajet = :id
    ";
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_agence_depart' => $data['id_agence_depart'],
            ':id_agence_arrivee' => $data['id_agence_arrivee'],
            ':date_heure_depart' => $data['date_heure_depart'],
            ':date_heure_arrivee' => $data['date_heure_arrivee'],
            ':nombre_places_total' => $data['nombre_places_total'],
            ':nombre_places_disponibles' => $data['nombre_places_disponibles'],
            ':id' => $id
        ]);
    }

    
}
