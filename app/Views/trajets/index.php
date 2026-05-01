<h1 class="mb-4">Trajets disponibles</h1>

<?php if (empty($trajets)): ?>
    <p>Aucun trajet disponible.</p>
<?php else: ?>

    <div class="row">
        <?php foreach ($trajets as $trajet): ?>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="card-title">
                            <?= htmlspecialchars($trajet['agence_depart']) ?>
                            →
                            <?= htmlspecialchars($trajet['agence_arrivee']) ?>
                        </h5>

                        <p class="card-text">
                            <strong>Départ :</strong>
                            <?= date('d/m/Y H:i', strtotime($trajet['date_heure_depart'])) ?><br>

                            <strong>Arrivée :</strong>
                            <?= date('d/m/Y H:i', strtotime($trajet['date_heure_arrivee'])) ?><br>

                            <strong>Places disponibles :</strong>
                            <?= $trajet['nombre_places_disponibles'] ?>
                        </p>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

<?php endif; ?>