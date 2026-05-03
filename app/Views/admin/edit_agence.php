
<?php /** @var array $agence */ ?>

<div class="container">
    <div>
        <h1>Modifier l'agence</h1>
    </div>
    <form action="/touche-pas-au-klaxon/public/index.php/admin/updateAgence/<?= $agence['id_agence'] ?>" method="POST">

        <label for="ville">Ville:</label>

        <input type="text" id="ville" name="ville" value="<?= htmlspecialchars($agence['ville']) ?>" required>
        <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>
    </form>

    <div class="mt-5">
        <a href="/touche-pas-au-klaxon/public/index.php/admin/agences" class="btn btn-secondary">Retour aux agences</a>
    </div>


</div>