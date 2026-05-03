<?php

namespace App\Controllers;

use App\Models\Agence;

class AdminController extends BaseController
{


    public function dashboard(): void
    {
        $this->requireAdmin();

        $this->render('admin/dashboard');
    }


    public function agences(): void
    {
        $this->requireAdmin();
        $agences = Agence::getAll();
        $this->render('admin/agences', ['agences' => $agences]);
    }

    public function createAgence(): void
    {
        $this->requireAdmin();
        $this->render('admin/create_agence');
    }

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

    public function deleteAgence(int $id): void{
        $this->requireAdmin();
        if (!Agence::findById($id)) {
            $_SESSION['error'] = "Agence non trouvée.";
            $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/agences');
        }
        Agence::delete($id);
        $_SESSION['success'] = "Agence supprimée avec succès !";
        $this->redirect('/touche-pas-au-klaxon/public/index.php/admin/agences');

    }
}
