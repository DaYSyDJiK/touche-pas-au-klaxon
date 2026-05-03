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
}
