<?php

namespace App\Controllers;

use App\Models\Trajet;

class TrajetsController extends BaseController
{
    public function index(): void
    {
        $trajets = Trajet::getTrajetsDisponibles();
        $this->render('trajets/index', ['trajets' => $trajets]);
    }
}
