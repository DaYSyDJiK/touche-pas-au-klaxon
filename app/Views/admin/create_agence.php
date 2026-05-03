<div class="container">

    <h1>Ajouter une agence</h1>

    <form method="POST" action="/touche-pas-au-klaxon/public/index.php/admin/storeAgence">

        <div class="my-3">
            <label>Ville</label>
            <input type="text" name="ville" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter l'agence</button>

    </form>

    <div class="mt-5">
        <a href="/touche-pas-au-klaxon/public/index.php/admin/agences" class="btn btn-secondary">Retour aux agences</a>
    </div>
</div>