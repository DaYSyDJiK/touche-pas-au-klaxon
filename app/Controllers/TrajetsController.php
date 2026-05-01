<?php

namespace App\Controllers;

use App\Models\Trajet;
use App\Models\Agence;

class TrajetsController extends BaseController
{
    public function index(): void
    {
        $trajets = Trajet::getTrajetsDisponibles();
        $this->render('trajets/index', ['trajets' => $trajets]);
    }

    public function create(): void
{
    $agences = Agence::getAll();

    $this->render('trajets/create', [
        'agences' => $agences
    ]);
}

public function store(): void
{
    Trajet::create($_POST, 1);

    $this->redirect('/touche-pas-au-klaxon/public/');
}

}
