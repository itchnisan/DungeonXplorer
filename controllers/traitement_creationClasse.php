<?php
session_start();

include_once "../models/connexionPDO.php";
include_once "../models/Classe.php";
include_once "../models/Guerrier.php";
include_once "../models/Voleur.php";
include_once "../models/Magicien.php";
include_once "../models/Hero.php";

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

    $hero = new Hero($nom,$role->getId(), $image, $biography, $role->getHealth(), $role->getMana(), $role->getStrength(), $role->getInitiative(),null, null, null, null, null, 0, 1);
    $_SESSION['hero'] = $hero;

    $sql = "INSERT INTO hero (nom, class_id, image, biography,pv, mana, strength,initiative,armor, primary_weapon, secondary_weapon, shield, spell_list, xp, current_level) 
    VALUES (:nom, :class_id, :image, :biography,:pv, :mana, :strength,:initiative,armor, :primary_weapon, :secondary_weapon, :shield, :spell_list, :xp, :current_level)";

    $cur = preparerRequetePDO($mysqlClient, $sql);

    ajouterParamPDO($cur, ':nom', $hero->getName());
    ajouterParamPDO($cur, ':class_id', $hero->getClassId());
    ajouterParamPDO($cur, ':image', $hero->getImage());
    ajouterParamPDO($cur, ':biography', $hero->getBiography());
    ajouterParamPDO($cur, ':pv', $hero->getPv());
    ajouterParamPDO($cur, ':mana', $hero->getMana());
    ajouterParamPDO($cur, ':strength', $hero->getStrength());
    ajouterParamPDO($cur, ':initiative', $hero->getInitiative());
    ajouterParamPDO($cur, ':armor', $hero->getArmor());
    ajouterParamPDO($cur, ':primary_weapon', $hero->getPrimaryWeapon());
    ajouterParamPDO($cur, ':secondary_weapon', $hero->getSecondaryweapon());
    ajouterParamPDO($cur, ':shield', $hero->getShield());
    ajouterParamPDO($cur, ':spell_list', $hero->getSpelllist());
    ajouterParamPDO($cur, ':xp', $hero->getXp());
    ajouterParamPDO($cur, ':current_level', $hero->getCurrentlevel());

    $res = majDonneesPrepareesPDO($cur);
}

if ($mysqlClient) {
    creerClasse($mysqlClient);
}
?>
