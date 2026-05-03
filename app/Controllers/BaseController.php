<?php

namespace App\Controllers;

/**
 * Classe mère de tous les contrôleurs
 */
abstract class BaseController
{
    /**
     * Affiche une vue avec des données
     */
    protected function render(string $view, array $data = []): void
    {
        extract($data);

        require '../app/Views/includes/header.php';
        require "../app/Views/{$view}.php";
        require '../app/Views/includes/footer.php';
    }


    protected function requireLogin(): void{
        if (empty($_SESSION['user'])) {
            $this->redirect('/touche-pas-au-klaxon/public/index.php/auth/login');
        }
    }

    protected function requireAdmin(): void
    {
        if (empty($_SESSION['user'])) {
            $this->redirect('/touche-pas-au-klaxon/public/index.php/auth/login');
        }
        if ($_SESSION['user']['role'] !== 'admin') {
            $_SESSION['error'] = 'Accès refusé : vous devez être administrateur pour accéder à cette page.';
            $this->redirect('/touche-pas-au-klaxon/public/index.php/auth/login');
        }
    }



    /**
     * Redirection HTTP
     */
    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
}
