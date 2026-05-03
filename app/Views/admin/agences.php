<div class="container">
<div>
    <h1>Gestion des agences</h1>
    <a href="/touche-pas-au-klaxon/public/index.php/admin/createAgence" class="btn btn-primary mb-3">Ajouter une agence</a>

    <?php if (empty($agences)): ?>
        <p>Aucune agence disponible.</p>
    <?php else: ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ville</th>
                <th>ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agences as $agence): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($agence['ville']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($agence['id_agence']) ?>
                    </td>
                    <td>
                        <a href="/touche-pas-au-klaxon/public/index.php/admin/editAgence/<?= $agence['id_agence'] ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <a href="/touche-pas-au-klaxon/public/index.php/admin/deleteAgence/<?= $agence['id_agence'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>