<?php
    
namespace App\Models;


/**
 * Modèle User
 */
class User extends BaseModel
{

    /**
     * Trouve un utilisateur par son email
     */
    public static function findByEmail(string $email): ?array
    {
        $pdo = self::getPDO();

        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    /**
    * Crée un nouvel utilisateur
    */
    public static function create(array $data): void{
        $pdo = self::getPDO();

        $sql = " INSERT INTO utilisateur (prenom, nom, email, mot_de_passe, role)
        VALUES (:prenom, :nom, :email, :mot_de_passe, :role)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':prenom' => $data['prenom'],
            ':nom' => $data['nom'],
            ':email' => $data['email'],
            ':mot_de_passe' => password_hash($data['mot_de_passe'], PASSWORD_DEFAULT),
            ':role' => 'user'
        ]);

    }

    /**
     * Retourne tous les utilisateurs
     */
    public static function getAll(): array{
        $pdo = self::getPDO();

        $sql = "SELECT id_utilisateur, prenom, nom, email, telephone, role FROM utilisateur ORDER BY nom ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}


?>