<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login(): void
    {
        $this->render('auth/login');
    }

    public function authenticate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/touche-pas-au-klaxon/public/index.php/auth/login');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = \App\Models\User::findByEmail($email);
        

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user'] = [
                'id' => $user['id_utilisateur'],
                'prenom' => $user['prenom'],
                'nom' => $user['nom'],
                'email' => $user['email'],
                'role' => $user['role'],
            ];

            $this->redirect('/touche-pas-au-klaxon/public/index.php/trajets');
        }

        $this->render('auth/login', [
            'error' => 'Email ou mot de passe incorrect.'
        ]);
    }

    public function logout(): void
    {
        session_destroy();

        $this->redirect('/touche-pas-au-klaxon/public/');
    }
}
