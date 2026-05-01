<h1 class="mb-4">Créer un trajet</h1>

<form method="POST" action="/touche-pas-au-klaxon/public/index.php/trajets/store">

    <!-- Agence de départ -->
    <div class="mb-3">
        <label class="form-label">Agence de départ</label>
        <select name="id_agence_depart" class="form-select">
            <option value="">Choisir une agence</option>

            <?php foreach ($agences as $agence): ?>
                <option value="<?= $agence['id_agence'] ?>">
                    <?= htmlspecialchars($agence['ville']) ?>
                </option>
            <?php endforeach; ?>

        </select>
    </div>

    <!-- Agence d'arrivée -->
    <div class="mb-3">
        <label class="form-label">Agence d'arrivée</label>
        <select name="id_agence_arrivee" class="form-select">
            <option value="">Choisir une agence</option>

            <?php foreach ($agences as $agence): ?>
                <option value="<?= $agence['id_agence'] ?>">
                    <?= htmlspecialchars($agence['ville']) ?>
                </option>
            <?php endforeach; ?>

        </select>
    </div>

    <!-- Date départ -->
    <div class="mb-3">
        <label class="form-label">Date et heure de départ</label>
        <input type="datetime-local" name="date_heure_depart" class="form-control">
    </div>

    <!-- Date arrivée -->
    <div class="mb-3">
        <label class="form-label">Date et heure d'arrivée</label>
        <input type="datetime-local" name="date_heure_arrivee" class="form-control">
    </div>

    <!-- Nombre de places -->
    <div class="mb-3">
        <label class="form-label">Nombre total de places</label>
        <input type="number" name="nombre_places_total" class="form-control" min="1">
    </div>

    <button type="submit" class="btn btn-primary">Créer le trajet</button>

</form>