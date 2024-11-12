<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Jeu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Barre supérieure avec logo et profil utilisateur -->
    <header>
        <div class="logo">LOGO</div>
        <div class="user-icon">Utilisateur</div>
    </header>

    <!-- Contenu principal -->
    <main>
        <!-- Titre du chapitre et boutons de profil/combat -->
        <section class="chapter">
            <h1>Titre du Chapitre</h1>
            <div class="actions">
                <button id="profile-btn">Profil</button>
                <button id="combat-btn">Combat</button>
            </div>
        </section>

        <!-- Contenu dynamique -->
        <section class="content">
            <p>Contenu du chapitre ici...</p>
            <div class="links">
                <a href="#">Lien 1</a>
                <a href="#">Lien 2</a>
                <a href="#">Lien 3</a>
            </div>
        </section>

        <!-- Section de l'inventaire/description -->
        <section class="details" id="details">
            <div class="character-info">
                <h2>Class</h2>
                <p>Bio</p>
                <p>Caractéristiques</p>
                <h3>Inventaire</h3>
                <p>Potion HP <button>Utiliser</button></p>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'autoload.php';

require_once 'model/connexionPDO.php';

?>
