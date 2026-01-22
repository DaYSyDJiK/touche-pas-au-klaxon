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

    /**
     * Redirection HTTP
     */
    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
}
