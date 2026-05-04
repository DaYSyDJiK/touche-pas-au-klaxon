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

                        <?php if (!empty($_SESSION['user'])): ?>
                            <button
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalTrajet<?= $trajet['id_trajet'] ?>">
                                Voir détails
                            </button>
                        <?php endif; ?>

                        <div class="modal fade" id="modalTrajet<?= $trajet['id_trajet'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Détails du trajet
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p><strong>Conducteur :</strong>
                                            <?= htmlspecialchars($trajet['auteur_prenom']) ?>
                                            <?= htmlspecialchars($trajet['auteur_nom']) ?>
                                        </p>

                                        <p><strong>Email :</strong>
                                            <?= htmlspecialchars($trajet['auteur_email']) ?>
                                        </p>

                                        <p><strong>Téléphone :</strong>
                                            <?= htmlspecialchars($trajet['auteur_telephone']) ?>
                                        </p>

                                        <p><strong>Places totales :</strong>
                                            <?= htmlspecialchars($trajet['nombre_places_total']) ?>
                                        </p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Fermer
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

<?php endif; ?>