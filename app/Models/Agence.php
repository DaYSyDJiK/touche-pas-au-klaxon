<?php

namespace App\Models;

class Agence extends BaseModel
{
    public static function getAll(): array
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_agence, ville FROM agence ORDER BY ville ASC";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll();
    }

    public static function findById(int $id): ?array
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_agence, ville FROM agence WHERE id_agence = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $agence = $stmt->fetch();

        return $agence ?: null;
            }

    public static function createAgence(string $ville): void
    {
        $pdo = self::getPDO();

        $sql = "INSERT INTO agence (ville) VALUES (:ville)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':ville' => $ville
        ]);
    }

    public static function deleteAgence(int $id): void
    {
        $pdo = self::getPDO();

        $sql = "DELETE FROM agence WHERE id_agence = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    public static function updateAgence(int $id, string $ville): void
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