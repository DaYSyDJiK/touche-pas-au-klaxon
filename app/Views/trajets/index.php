<h1>Trajets disponibles</h1>

<?php if (empty($trajets)): ?>
    <p>Aucun trajet disponible.</p>
<?php else: ?>
    <ul>
    <?php foreach ($trajets as $trajet): ?>
        <li>
            <?= htmlspecialchars($trajet['agence_depart']) ?> →
            <?= htmlspecialchars($trajet['agence_arrivee']) ?>
            (Départ : <?= $trajet['date_heure_depart'] ?>)
            - Places dispo : <?= $trajet['nombre_places_disponibles'] ?>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>


