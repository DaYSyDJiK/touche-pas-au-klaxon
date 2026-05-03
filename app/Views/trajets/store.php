public function store(): void
{
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
$this->redirect('/touche-pas-au-klaxon/public/index.php/trajets/create');
}

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
$errors[]="Le nombre de places doit être supérieur à 0." ;
}

    // Si erreurs
    if (!empty($errors)) {
    $agences=Agence::getAll();

    $this->render('trajets/create', [
    'errors' => $errors,
    'agences' => $agences
    ]);

    return;
    }


    
    
    // Sinon insertion
    Trajet::create($_POST, 1);
    
    $_SESSION['success'] = "Trajet créé avec succès !";

    
    $this->redirect('/touche-pas-au-klaxon/public/');
    }