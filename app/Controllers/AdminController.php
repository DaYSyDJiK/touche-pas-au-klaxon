<?php

namespace App\Controllers;

use App\Models\Agence;
use App\Models\User;
use App\Models\Trajet;


/**
 * Contrôleur pour les actions d'administration
 */

class AdminController extends BaseController
{

    /**
     * Affiche le tableau de bord admin
     */
    public function dashboard(): void
    {
        $this->requireAdmin();

        $this->render('admin/dashboard');
    }

    /**
     * Affiche la liste des agences
     */
    public function agences(): void
    {
        $this->requireAdmin();
        $agences = Agence::getAll();
        $this->render('admin/agences', ['agences' => $agences]);
    }

    /**
     * Affiche le formulaire de création d'une agence
     */
    public function createAgence(): void
    {
        $this->requireAdmin();
        $this->render('admin/create_agence');
    }


    /**
     * Traite la création d'une agence
     */
    public function storeAgence(): void
    {
        $this->requireAdmin();
        $ville = trim($_POST['ville'] ?? '');
        if (empty($ville)) {
            $_SESSION['error'] = "La ville ne peut pas être vide.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/createAgence');
            return;
        }

        Agence::create($ville);

        $_SESSION['success'] = "Agence créée avec succès !";

        $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/agences');
    }


    /**
     * Affiche le formulaire d'édition d'une agence
     */
    public function editAgence(int $id): void
    {

        $this->requireAdmin();
        $agence = Agence::findById($id);
        if (!$agence) {
            $_SESSION['error'] = "Agence non trouvée.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/agences');
            return;
        }
        $this->render('admin/edit_agence', ['agence' => $agence]);
    }


    /**
     * Traite la mise à jour d'une agence
     */
    public function updateAgence(int $id): void
    {
        $this->requireAdmin();
        $ville = trim($_POST['ville'] ?? '');
        if (empty($ville)) {
            $_SESSION['error'] = "La ville ne peut pas être vide.";
            $this->redirect("/touche-pas-au-klaxon/public/index.php/admin/editAgence/{$id}");
            return;
        }

        Agence::update($id, $ville);

        $_SESSION['success'] = "Agence mise à jour avec succès !";

        $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/agences');
    }

    /**
     * Traite la suppression d'une agence
     */
    public function deleteAgence(int $id): void
    {
        $this->requireAdmin();
        if (!Agence::findById($id)) {
            $_SESSION['error'] = "Agence non trouvée.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/agences');
            return;
        }
        Agence::delete($id);
        $_SESSION['success'] = "Agence supprimée avec succès !";
        $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/agences');
    }

    /**
     * Affiche la liste des utilisateurs
     */
    public function users(): void
    {
        $this->requireAdmin();
        $users = User::getAll();
        $this->render('admin/users', ['users' => $users]);
    }

    /**
     * Affiche la liste des trajets
     */

    public function trajets(): void
    {
        $this->requireAdmin();
        $trajets = Trajet::getAll();
        $this->render('admin/trajets', ['trajets' => $trajets]);
    }

    /**
     * Traite la suppression d'un trajet
     */
    public function deleteTrajet(int $id): void
    {
        $this->requireAdmin();
        if (!Trajet::findById($id)) {
            $_SESSION['error'] = "Trajet non trouvé.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/trajets');
            return;
        }
        Trajet::delete($id);
        $_SESSION['success'] = "Trajet supprimé avec succès !";
        $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/trajets');
    }

    /**
     * Affiche le formulaire d'édition d'un trajet
     */
    public function editTrajet(int $id): void
    {
        $this->requireAdmin();

        $trajet = Trajet::findById($id);

        if (!$trajet) {
            $_SESSION['error'] = "Trajet non trouvé.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/trajets');
            return;
        }

        $agences = Agence::getAll();

        $this->render('admin/edit_trajet', [
            'trajet' => $trajet,
            'agences' => $agences
        ]);
    }

    /**
     * Traite la mise à jour d'un trajet
     */
    public function updateTrajet(int $id): void
    {
        $this->requireAdmin();
        $errors = [];
        // Vérifier les champs
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
            $this->render('admin/edit_trajet', [
                'errors' => $errors,
                'trajet' => $trajet,
                'agences' => $agences
            ]);
            return;
        }

        Trajet::update($id, $_POST);
        $_SESSION['success'] = "Trajet mis à jour avec succès !";
        $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/trajets');
    }
}
