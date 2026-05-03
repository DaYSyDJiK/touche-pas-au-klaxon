<?php /** @var array $trajets */ ?>

<div class="container">
    <h1>Gérer les trajets</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>Agence de départ</th>
                <th>Agence d'arrivée</th>
                <th>Date et heure de départ</th>
                <th>Date et heure d'arrivée</th>
                <th>Nombre de places disponibles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trajets as $trajet): ?>
                <tr>
                    <td><?=  htmlspecialchars($trajet['agence_depart']) ?></td>
                    <td><?=  htmlspecialchars($trajet['agence_arrivee']) ?></td>
                    <td><?=  htmlspecialchars($trajet['date_heure_depart']) ?></td>
                    <td><?=  htmlspecialchars($trajet['date_heure_arrivee']) ?></td>
                    <td><?=  htmlspecialchars($trajet['nombre_places_disponibles']) ?></td>
                    <td>
                        <a href="/touche-pas-au-klaxon/public/index.php/admin/editTrajet/<?= $trajet['id_trajet'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                        <a href="/touche-pas-au-klaxon/public/index.php/admin/deleteTrajet/<?= $trajet['id_trajet'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>