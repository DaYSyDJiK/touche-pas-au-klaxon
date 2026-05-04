# Touche pas au klaxon

## Description

Touche pas au klaxon est une application web développée en PHP suivant une architecture MVC.  
Elle permet aux utilisateurs de proposer et consulter des trajets entre différentes agences, avec un système d’authentification et un espace administrateur.

---

## Installation

### 1. Cloner le projet

```bash
git clone https://github.com/DaYSyDJiK/touche-pas-au-klaxon.git

---

### 2. Lancer XAMPP

Démarrer Apache
Démarrer MySQL

---

### 3. Créer la base de données

Ouvrir phpMyAdmin

Créer une base :
klaxon

Importer :
create_database.sql
seed_database.sql

---

### 4. Installer les dépendances

composer install

---

### 5. Lancer le projet

Accéder à :

http://localhost/touche-pas-au-klaxon/public/

---

### Comptes de test

Admin
Email : maxime@test.com
Mot de passe : 1234

Utilisateur
Email : user@test.com
Mot de passe : 1234

---

### Fonctionnalités

### Authentification

Connexion / Déconnexion
Sécurisation des routes
Gestion des rôles (admin / utilisateur)


### Utilisateur

Voir les trajets disponibles
Voir les détails d’un trajet (modale)
Créer un trajet
Voir ses trajets
Modifier ses trajets
Supprimer ses trajets


### Administration

Dashboard admin
Gestion des agences :
création
modification
suppression
Liste des utilisateurs
Gestion des trajets :
visualisation
modification
suppression

---

### Architecture

Le projet suit une architecture MVC :

app/
 ├── Controllers/
 ├── Models/
 ├── Views/
public/
config/

---

### Base de données

Tables principales

-utilisateur
-agence
-trajet

---

### MCD / MLD / Cardinalités

Voir le dossier "docs" à la racine du projet

---

### Sécurité

Vérification utilisateur connecté
Vérification rôle admin
Vérification propriété des trajets
Protection XSS avec htmlspecialchars
Mots de passe hashés (password_hash / password_verify)

---

### Qualité du code

✔ PHPStan (analyse statique)
✔ PHPUnit (tests unitaires)
✔ DocBlock

---

### Front-end

Bootstrap 5
Sass (couleurs personnalisées)

---

### Auteur

Maxime Gauthier
Projet réalisé dans le cadre d’un apprentissage du développement web en PHP.

---

### Lien GitHub

https://github.com/DaYSyDJiK/touche-pas-au-klaxon