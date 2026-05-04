<?php

namespace App\Controllers;

use App\Models\Trajet;
use App\Models\Agence;

/*
 * Contrôleur pour les actions liées aux trajets
 */
class TrajetsController extends BaseController
{   

    /**
     * Affiche la liste des trajets disponibles
     */
    public function index(): void
    {
        $trajets = Trajet::getTrajetsDisponibles();
        $this->render('trajets/index', ['trajets' => $trajets]);
    }

    /**
     * Affiche le formulaire de création d'un trajet
     */
    public function create(): void
    {
        $this->requireLogin();
        $agences = Agence::getAll();

        $this->render('trajets/create', [
            'agences' => $agences
        ]);
    }

    /**
     * Traite la création d'un trajet
     */
    public function store(): void
    {
        $this->requireLogin();

        $errors = [];

        if (empty($_POST['id_agence_depart']) || empty($_POST['id_agence_arrivee'])) {
            $errors[] = "Les agences sont obligatoires.";
        }

        if (!empty($_POST['id_agence_depart']) && $_POST['id_agence_depart'] === $_POST['id_agence_arrivee']) {
            $errors[] = "L'agence de départ et d'arrivée doivent être différentes.";
        }

        if (empty($_POST['date_heure_depart']) || empty($_POST['date_heure_arrivee'])) {
            $errors[] = "Les dates sont obligatoires.";
        }

        if (!empty($_POST['date_heure_depart']) && !empty($_POST['date_heure_arrivee']) && $_POST['date_heure_depart'] >= $_POST['date_heure_arrivee']) {
            $errors[] = "La date d'arrivée doit être après la date de départ.";
        }

        if (empty($_POST['nombre_places_total']) || $_POST['nombre_places_total'] <= 0) {
            $errors[] = "Le nombre de places doit être supérieur à 0.";
        }

        if (!empty($errors)) {
            $agences = Agence::getAll();

            $this->render('trajets/create', [
                'errors' => $errors,
                'agences' => $agences
            ]);
            return;
        }

        Trajet::create($_POST, (int) $_SESSION['user']['id']);

        $_SESSION['success'] = "Trajet créé avec succès !";

        $this->redirect('/touche-pas-au-klaxon/public/index.php/trajets/mesTrajets');
    }

    /**
     * Affiche les trajets de l'utilisateur connecté
     */
    public function mesTrajets(): void
    {
        $this->requireLogin();
        $idUtilisateur = $_SESSION['user']['id'];
        $trajets = Trajet::getByUser($idUtilisateur);
        $this->render('trajets/mes_trajets', ['trajets' => $trajets]);
    }

    /**
     * Affiche le formulaire d'édition d'un trajet
     */
    public function edit(int $id): void
    {
        $this->requireLogin();
        $trajet = Trajet::findById($id);
        if (!$trajet) {
            $_SESSION['error'] = "Trajet non trouvé.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/trajets/mesTrajets');
            return;
        }
        if ((int) $trajet['id_utilisateur'] !== (int) $_SESSION['user']['id']) {
            $_SESSION['error'] = "Accès refusé : vous ne pouvez modifier que vos propres trajets.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/trajets/mesTrajets');
            return;
        }
        $agences = Agence::getAll();
        $this->render('trajets/edit', [
            'trajet' => $trajet,
            'agences' => $agences
        ]);
        return;
    }

    /**
     * Traite la mise à jour d'un trajet
     */
    public function update(int $id): void
    {
        $this->requireLogin();
        $trajet = Trajet::findById($id);
        if (!$trajet) {
            $_SESSION['error'] = "Trajet non trouvé.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/trajets/mesTrajets');
            return;
        }
        if ((int) $trajet['id_utilisateur'] !== (int) $_SESSION['user']['id']) {
            $_SESSION['error'] = "Accès refusé : vous ne pouvez modifier que vos propres trajets.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/trajets/mesTrajets');
            return;
        }

        // valider les champs

        $errors = [];

        if (empty($_POST['id_agence_depart']) || empty($_POST['id_agence_arrivee'])) {
            $errors[] = "Les agences sont obligatoires.";
        }
        if ($_POST['id_agence_depart'] === $_POST['id_agence_arrivee']) {
            $errors[] = "L'agence de départ et d'arrivée doivent être différentes.";
        }
        if (empty($_POST['date_heure_depart']) || empty($_POST['date_heure_arrivee'])) {
            $errors[] = "Les dates sont obligatoires.";
        }
        if ($_POST['date_heure_depart'] >= $_POST['date_heure_arrivee']) {
            $errors[] = "La date d'arrivée doit être après la date de départ.";
        }
        if (empty($_POST['nombre_places_total']) || $_POST['nombre_places_total'] <= 0) {
            $errors[] = "Le nombre de places doit être supérieur à 0.";
        }

        // Si erreurs
        if (!empty($errors)) {
            $trajet = Trajet::findById($id);
            $agences = Agence::getAll();
            $this->render('trajets/edit', [
                'errors' => $errors,
                'trajet' => $trajet,
                'agences' => $agences
            ]);
            return;
        }

        Trajet::update($id, $_POST);
        $_SESSION['success'] = "Trajet mis à jour avec succès !";
        $this->redirect('/touche-pas-au-klaxon/public/index.php/trajets/mesTrajets');
        return;
    }


    /**
     * Traite la suppression d'un trajet
     */
    public function delete(int $id): void
    {
        $this->requireLogin();
        $trajet = Trajet::findById($id);
        if (!$trajet) {
            $_SESSION['error'] = "Trajet non trouvé.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/trajets/mesTrajets');
            return;
        }
        if ((int) $trajet['id_utilisateur'] !== (int) $_SESSION['user']['id']) {
            $_SESSION['error'] = "Accès refusé : vous ne pouvez supprimer que vos propres trajets.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/trajets/mesTrajets');
            return;
        }

        Trajet::delete($id);
        $_SESSION['success'] = "Trajet supprimé avec succès !";
        $this->redirect('/touche-pas-au-klaxon/public/index.php/trajets/mesTrajets');
        return;
    }
}
