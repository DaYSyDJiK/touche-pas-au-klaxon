<?php
/** @var array $trajet */
/** @var array $agences */
/** @var array|null $errors */
?>

<div class="container">
    <h1>Modifier le trajet</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/touche-pas-au-klaxon/public/index.php/admin/updateTrajet/<?= $trajet['id_trajet'] ?>" method="POST">

        <div class="mb-3">
            <label for="id_agence_depart" class="form-label">Agence de départ</label>
            <select id="id_agence_depart" name="id_agence_depart" class="form-select">
                <option value="">Choisir une agence</option>

                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id_agence'] ?>"
                        <?= (int)$agence['id_agence'] === (int)$trajet['id_agence_depart'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_agence_arrivee" class="form-label">Agence d'arrivée</label>
            <select id="id_agence_arrivee" name="id_agence_arrivee" class="form-select">
                <option value="">Choisir une agence</option>

                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id_agence'] ?>"
                        <?= (int)$agence['id_agence'] === (int)$trajet['id_agence_arrivee'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="date_heure_depart" class="form-label">Date et heure de départ</label>
            <input
                type="datetime-local"
                id="date_heure_depart"
                name="date_heure_depart"
                value="<?= date('Y-m-d\TH:i', strtotime($trajet['date_heure_depart'])) ?>"
                class="form-control"
            >
        </div>

        <div class="mb-3">
            <label for="date_heure_arrivee" class="form-label">Date et heure d'arrivée</label>
            <input
                type="datetime-local"
                id="date_heure_arrivee"
                name="date_heure_arrivee"
                value="<?= date('Y-m-d\TH:i', strtotime($trajet['date_heure_arrivee'])) ?>"
                class="form-control"
            >
        </div>

        <div class="mb-3">
            <label for="nombre_places_total" class="form-label">Nombre de places total</label>
            <input
                type="number"
                id="nombre_places_total"
                name="nombre_places_total"
                value="<?= htmlspecialchars($trajet['nombre_places_total']) ?>"
                class="form-control"
                min="1"
            >
        </div>

        <div class="mb-3">
            <label for="nombre_places_disponibles" class="form-label">Nombre de places disponibles</label>
            <input
                type="number"
                id="nombre_places_disponibles"
                name="nombre_places_disponibles"
                value="<?= htmlspecialchars($trajet['nombre_places_disponibles']) ?>"
                class="form-control"
                min="0"
            >
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>

        <a href="/touche-pas-au-klaxon/public/index.php/admin/trajets" class="btn btn-secondary">
            Retour aux trajets
        </a>
    </form>
</div>