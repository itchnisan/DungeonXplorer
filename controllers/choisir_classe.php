<?php
session_start();

// Vérification : L'utilisateur est-il connecté ?
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirige vers la page de connexion si non connecté
    header("Location: ../views/formulaire_connexion.php");
    exit();
}

header("Location: ../views/formulaire_classe.php");
exit();
?>