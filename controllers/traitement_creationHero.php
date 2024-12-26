<?php
session_start();

include_once "../models/connexionPDO.php";
include_once "../models/Class.php";
include_once "../models/Guerrier.php";
include_once "../models/Voleur.php";
include_once "../models/Magicien.php";
include_once "../models/Hero.php";

function creerClasse($mysqlClient) {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (!empty($_POST["nom"]) /*&& !empty($_POST["image"]*/  && !empty($_POST["biography"]))/*)*/ {
            $nom = $_POST["nom"];
            //$image = $_POST["image"];
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
            $role = new Guerrier($mysqlClient);
            break;
        case 'voleur':
            $role = new Voleur($mysqlClient);
            break;
        case 'magicien':
            $role = new Magicien($mysqlClient);
            break;
        default:
            echo "Rôle invalide.";
            return;
    }

    $image = null;

    $sql = "INSERT INTO Hero (user_id,hero_id,hero_name, class_id, hero_image, hero_biography,hero_pv, hero_mana, hero_strength,hero_initiative, hero_xp,hero_bourse_or, current_level) 
    VALUES (:user_id,:hero_id, :nom, :class_id, :image, :biography,:pv, :mana, :strength,:initiative, :xp,:bourseOr, :current_level)";

    $cur = preparerRequetePDO($mysqlClient, $sql);

    $userId = $_SESSION['numero'];
    $hero_id = null;
    $heroName = $nom;
    $heroClassId = $role->getClassId();
    $heroImage = $image;
    $heroBiography = $biography;
    $heroPv = $role->getClassBasePv();
    $heroMana = $role->getClassBaseMana();
    $heroStrength = $role->getClassStrength();
    $heroInitiative = $role->getClassInitiative();
    $heroBourseOr = 0;
    $heroXp = 0;
    $heroCurrentLevel = 1;
    
    ajouterParamPDO($cur, ':user_id', $userId);
    ajouterParamPDO($cur, ':hero_id', $hero_id);
    ajouterParamPDO($cur, ':nom', $heroName);
    ajouterParamPDO($cur, ':class_id', $heroClassId);
    ajouterParamPDO($cur, ':image', $heroImage);
    ajouterParamPDO($cur, ':biography', $heroBiography);
    ajouterParamPDO($cur, ':pv', $heroPv);
    ajouterParamPDO($cur, ':mana', $heroMana);
    ajouterParamPDO($cur, ':strength', $heroStrength);
    ajouterParamPDO($cur, ':initiative', $heroInitiative);
    ajouterParamPDO($cur, ':xp', $heroXp);
    ajouterParamPDO($cur, ':bourseOr', $heroBourseOr);
    ajouterParamPDO($cur, ':current_level', $heroCurrentLevel);

    $res = majDonneesPrepareesPDO($cur);

    $hero = new Hero();

    $id = $_SESSION['numero'];
    $hero->firstMajFromPDO($id);
    $_SESSION['hero'] = $hero;
}

if ($mysqlClient) {
    creerClasse($mysqlClient);
}
?>
