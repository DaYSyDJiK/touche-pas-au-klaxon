<?php

namespace App\Models;

use PDO;

/**
 * Classe mère de tous les modèles
 * Gère la connexion PDO à la base de données
 */
abstract class BaseModel
{
    /**
     * Instance PDO partagée
     */
    protected static ?PDO $pdo = null;

    /**
     * Retourne l'instance PDO (singleton simple)
     */
    protected static function getPDO(): PDO
    {
        if (self::$pdo === null) {
            self::$pdo = require __DIR__ . '/../../config/database.php';
        }

        return self::$pdo;
    }
}
