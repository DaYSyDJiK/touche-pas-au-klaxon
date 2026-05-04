<?php

namespace App\Models;


/**
 * Modèle Agence
 */
class Agence extends BaseModel
{

    /**
     * Retourne toutes les agences
     */
    public static function getAll(): array
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_agence, ville FROM agence ORDER BY ville ASC";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll();
    }

    /**
     * Retourne une agence par son ID
     */
    public static function findById(int $id): ?array
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_agence, ville FROM agence WHERE id_agence = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $agence = $stmt->fetch();

        return $agence ?: null;
            }


    /**
     * Crée une nouvelle agence
     */
    public static function create(string $ville): void
    {
        $pdo = self::getPDO();

        $sql = "INSERT INTO agence (ville) VALUES (:ville)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':ville' => $ville
        ]);
    }

    /**
     * Supprime une agence
     */
    public static function delete(int $id): void
    {
        $pdo = self::getPDO();

        $sql = "DELETE FROM agence WHERE id_agence = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    /**
     * Met à jour une agence
     */
    public static function update(int $id, string $ville): void
    {
        $pdo = self::getPDO();

        $sql = "UPDATE agence SET ville = :ville WHERE id_agence = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':ville' => $ville,
            ':id' => $id
        ]);
    }
}