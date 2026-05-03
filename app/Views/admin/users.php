<?php /** @var array $users */ ?>


<div class="container">
    <h1>Gérer les utilisateurs</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?=  htmlspecialchars($user['nom']) ?></td>
                    <td><?=  htmlspecialchars($user['prenom']) ?></td>
                    <td><?=  htmlspecialchars($user['email']) ?></td>
                    <td><?=  htmlspecialchars($user['telephone']) ?></td>
                    <td><?=  htmlspecialchars($user['role']) ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>