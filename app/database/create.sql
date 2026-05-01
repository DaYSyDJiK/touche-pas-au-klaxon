-- Suppression des tables si elles existent
DROP TABLE IF EXISTS trajet;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS agence;

-- Table AGENCE
CREATE TABLE agence (
    id_agence INT AUTO_INCREMENT PRIMARY KEY,
    ville VARCHAR(100) NOT NULL
);

-- Table UTILISATEUR
CREATE TABLE utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(100),
    nom VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    mot_de_passe VARCHAR(255),
    telephone VARCHAR(20),
    role VARCHAR(20)
);

-- Table TRAJET
CREATE TABLE trajet (
    id_trajet INT AUTO_INCREMENT PRIMARY KEY,

    id_utilisateur INT NOT NULL,
    id_agence_depart INT NOT NULL,
    id_agence_arrivee INT NOT NULL,

    date_heure_depart DATETIME NOT NULL,
    date_heure_arrivee DATETIME NOT NULL,

    nombre_places_total INT NOT NULL,
    nombre_places_disponibles INT NOT NULL,

    -- Clés étrangères
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    FOREIGN KEY (id_agence_depart) REFERENCES agence(id_agence),
    FOREIGN KEY (id_agence_arrivee) REFERENCES agence(id_agence)
);