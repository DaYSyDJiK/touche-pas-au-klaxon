<h1>Trajets disponibles</h1>

<?php if (empty($trajets)): ?>
    <p>Aucun trajet disponible.</p>
<?php else: ?>
    <ul>
    <?php foreach ($trajets as $trajet): ?>
        <li>
            <?= htmlspecialchars($trajet['agence_depart']) ?> →
            <?= htmlspecialchars($trajet['agence_arrivee']) ?> <br>
            (Départ : <?= date('d/m/Y H:i', strtotime($trajet['date_heure_depart'])) ?>) <br>
            (Arrivée : <?= date('d/m/Y H:i', strtotime($trajet['date_heure_arrivee'])) ?>) <br>
            Places dispo : <?= $trajet['nombre_places_disponibles'] ?>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>


