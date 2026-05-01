-- Agences
INSERT INTO agence (ville) VALUES
('Bordeaux'),
('Toulouse'),
('Paris');

-- Utilisateur
INSERT INTO utilisateur (prenom, nom, email, mot_de_passe, telephone, role) VALUES
('Maxime', 'Test', 'maxime@test.com', '1234', '0600000000', 'admin');

-- Trajets (attention aux dates futures)
INSERT INTO trajet (
    id_utilisateur,
    id_agence_depart,
    id_agence_arrivee,
    date_heure_depart,
    date_heure_arrivee,
    nombre_places_total,
    nombre_places_disponibles
) VALUES
(1, 1, 2, '2026-06-01 10:00:00', '2026-06-01 14:00:00', 4, 3),
(1, 2, 3, '2026-06-05 09:00:00', '2026-06-05 15:00:00', 3, 2);