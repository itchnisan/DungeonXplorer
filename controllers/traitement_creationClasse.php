<?php
session_start();

include_once "../models/connexionPDO.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['role']) && !empty($_POST['role'])) {
        $role = htmlspecialchars($_POST['role']);
        echo "Vous avez choisi le rôle : " . $role;
    } else {
        echo "Aucun rôle sélectionné. Veuillez choisir un rôle.";
    }
} else {
    echo "Formulaire non soumis correctement.";
}
?>
