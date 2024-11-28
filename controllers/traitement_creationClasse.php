<?php
session_start();

$role = 'voleur';

include_once "../models/connexionPDO.php";
include_once "../models/Classe.php";
include_once "../models/Guerrier.php";
include_once "../models/Voleur.php";
include_once "../models/Magicien.php";

function creerClasse($mysqlClient) {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (!empty($_POST["nom"]) && !empty($_POST["image"]  && !empty($_POST["biography"]))) {
            $nom = $_POST["nom"];
            $image = $_POST["image"];
            $biography = $_POST["biography"];
        } else {
            $erreur = 1; // Fields are not filled
        }

        if (isset($_POST['role']) && !empty($_POST['role'])) {
            $role = htmlspecialchars($_POST['role']);
            echo "Vous avez choisi le rôle : " . $role;
        } else {
            echo "Aucun rôle sélectionné. Veuillez choisir un rôle.";
        }
    } else {
        echo "Formulaire non soumis correctement.";
    }

    switch($role) {
        case 'guerrier':
            $role = new Guerrier();
            break;
        case 'voleur':
            $role = new Voleur();
            break;
        case 'magicien':
            $role = new Magicien();
            break;
        default:
            echo "Rôle invalide.";
            return;
    }

    $sql = "INSERT INTO hero (nom, class_id, image, biography,pv, mana, strength,initiative,armor, primary_weapon, secondary_weapon, shield, spell_list, xp, current_level) 
    VALUES (:nom, :class_id, :image, :biography,:pv, :mana, :strength,:initiative,armor, :primary_weapon, :secondary_weapon, :shield, :spell_list, :xp, :current_level)";

    $stmt = $mysqlClient->prepare($sql);

    $data = [ //On pourra permettre de démarrer avec une arme,une armure ou meme niveaux en +
        'nom' => $nom,
        'class_id' => $role->getId(),
        'image' => $image,
        'biography' => $biography,
        'pv' => $role->getHealth(),
        'mana' => $role->getMana(),
        'strength' => $role->getStrength(),
        'initiative' => $role->getInitiative(),
        'armor' => null,
        'primary_weapon' => null,
        'secondary_weapon' => null,
        'shield' => null,
        'spell_list' => null,
        'xp' => 0,
        'current_level' => 1
    ];

    $stmt->execute($data);
}

if ($mysqlClient) {
    creerClasse($mysqlClient);
}
?>
