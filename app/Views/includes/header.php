<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Touche pas au klaxon</title>
    <link rel="stylesheet" href="/touche-pas-au-klaxon/public/assets/css/main.css">
</head>

<body>


    <header class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
        <h1>Touche pas au klaxon</h1>
        <nav>
            <a href="http://localhost/touche-pas-au-klaxon/public/index.php/trajets" class="btn btn-outline-light">Trajets</a>
            <?php if (!empty($_SESSION['user'])): ?>
                <span class="mx-2">Bonjour <?= htmlspecialchars($_SESSION['user']['prenom']) ?></span>
                <a href="http://localhost/touche-pas-au-klaxon/public/index.php/trajets/create" class="btn btn-outline-light">Créer un trajet</a>
                <a href="http://localhost/touche-pas-au-klaxon/public/index.php/auth/logout" class="btn btn-outline-light">Déconnexion</a>
            <?php endif; ?>

            <?php if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="http://localhost/touche-pas-au-klaxon/public/index.php/admin/dashboard" class="btn btn-outline-light">Admin</a>
            <?php endif; ?>

            <?php if (empty($_SESSION['user'])): ?>
                <a href="http://localhost/touche-pas-au-klaxon/public/index.php/auth/login" class="btn btn-outline-light">Connexion</a>
            <?php endif; ?>
        </nav>
    </header>


    <main class="container mt-4">





        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>