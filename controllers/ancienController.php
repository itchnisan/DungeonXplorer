<?php
session_start();

include_once "../models/connexionPDO.php";
include_once "../models/Hero.php";

function getPersoFromDatabase($db) {
    if (!isset($_SESSION['numero'])) {
        die('User ID not set in session.');
    }

    // Jointure entre la table hero et class pour obtenir les détails du rôle
    $sql = "SELECT hero.*, class.class_name
            FROM hero 
            JOIN class ON hero.class_id = class.class_id
            WHERE hero.user_id = :user_id";

    $cur = preparerRequetePDO($db, $sql);
    ajouterParamPDO($cur, ':user_id', $_SESSION['numero'], 'texte');
    
    $donnee = [];
    LireDonneesPDOPreparee($cur, $donnee);
    
    if (!empty($donnee)) {
        // Stocke les données du héros et de sa classe dans la session
        $_SESSION['hero_data'] = $donnee[0]; // Premier résultat
        header("Location: ../views/ancienhero.php"); // Redirige vers la page du héros
        exit;
    } else {
        echo "<script>alert('No hero found'); window.location.href = '../controllers/traitement_creationClasse.php';</script>";
    }
}

if ($mysqlClient) {
    getPersoFromDatabase($mysqlClient);
}
?>

