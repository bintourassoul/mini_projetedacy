    Application de Gestion de livres
Une application web simple en PHP permettant :
L’inscription et l’authentification des utilisateurs
La gestion des livres (CRUD)
La visualisation des utilisateurs inscrits

     Fonctionnalités
Authentification
Inscription avec nom, email et mot de passe (hashé)
Connexion sécurisée avec email et mot de passe

    Livres
Ajouter un livre
Modifier un livre
Supprimer un livre
Voir la liste des livres

   Utilisateurs
Visualisation de la liste des utilisateurs inscrits

Technologies utilisées

PHP
MySQL
HTML/CSS 
Serveur local WAMP
PhpMyAdmin

Structure du projet

/appsuividelecturebackend/
│
├── inscription.php         # Formulaire d'inscription
├── connexion.php           # Formulaire de connexion
├── deconnexion.php         # Déconnexion
├── dashboard.php           # Page protégée
├── ajouter_livre.php       # Ajout d’un livre
├── modifier_livre.php      # Modification d’un livre
├── supprimer_livre.php     # Suppression d’un livre
├── liste_utilisateurs.php  # Voir les utilisateurs inscrits
├── index.php               # Liste des livres
├── README.md               # Ce fichier

      Installation
Clone ce dépôt ou copie les fichiers dans C:/wamp64/www/edacy/appsuividelecturebackend/
Lance WAMP ou XAMPP
Crée la base de données bdg dans phpMyAdmin
Crée les tables suivantes :

Table utilisateurs
CREATE TABLE utilisateurs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100),
  email VARCHAR(100),
  mot_de_passe VARCHAR(255)
);

Table livres
CREATE TABLE livres (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titre VARCHAR(255),
  auteur VARCHAR(255),
);
