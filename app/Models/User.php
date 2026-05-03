<?php
    
namespace App\Models;

class User extends BaseModel
{
    public static function findByEmail(string $email): ?array
    {
        $pdo = self::getPDO();

        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

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
}


?>