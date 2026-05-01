public function store(): void
{
    Trajet::create($_POST, 1); // utilisateur temporaire

    $this->redirect('/touche-pas-au-klaxon/public/');
}