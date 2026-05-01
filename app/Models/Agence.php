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
}