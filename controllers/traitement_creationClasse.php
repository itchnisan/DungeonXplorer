<?php
session_start();

include_once "../models/connexionPDO.php";
include_once "../models/Class.php";
include_once "../models/Guerrier.php";
include_once "../models/Voleur.php";
include_once "../models/Magicien.php";
include_once "../models/Hero.php";
include_once "../views/formulaire_classe.php";

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirige vers la page de connexion si non connecté
    header("Location: ../views/formulaire_connexion.php");
    exit();
}

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
    
    $hero = new Hero($_SESSION['numero'],$nom,$role->getClassId(), $image, $biography, $role->getClassBasePv(), $role->getClassBaseMana(), $role->getClassStrength(), $role->getClassInitiative(),0, 0, 1);
    
    $_SESSION['hero'] = $hero;

    //modifier bdd pour qu'elle associe directement des spell ,armes et armures aux classes

    // $sql = "INSERT INTO Hero (user_id,hero_name, class_id, hero_image, hero_biography,hero_pv, hero_mana, hero_strength,hero_initiative,hero_armor, primary_weapon, secondary_weapon, shield, spell_list, xp, current_level) 
    // VALUES (:user_id, :nom, :class_id, :image, :biography,:pv, :mana, :strength,:initiative,:armor, :primary_weapon, :secondary_weapon, :shield, :spell_list, :xp, :current_level)";

    $sql = "INSERT INTO Hero (user_id,hero_name, class_id, hero_image, hero_biography,hero_pv, hero_mana, hero_strength,hero_initiative, hero_xp, current_level) 
    VALUES (:user_id, :nom, :class_id, :image, :biography,:pv, :mana, :strength,:initiative,:xp, :current_level)";


    $cur = preparerRequetePDO($mysqlClient, $sql);

    $userId = $hero->getUserId();
    $heroName = $hero->getHeroName();
    $heroClassId = $hero->getClassId();
    $heroImage = $hero->getHeroImage();
    $heroBiography = $hero->getHeroBiography();
    $heroPv = $hero->getHeroPv();
    $heroMana = $hero->getHeroMana();
    $heroStrength = $hero->getHeroStrength();
    $heroInitiative = $hero->getHeroInitiative();
    $heroXp = $hero->getHeroXp();
    $heroCurrentLevel = $hero->getCurrentlevel();
    
    ajouterParamPDO($cur, ':user_id', $userId);
    ajouterParamPDO($cur, ':nom', $heroName);
    ajouterParamPDO($cur, ':class_id', $heroClassId);
    ajouterParamPDO($cur, ':image', $heroImage);
    ajouterParamPDO($cur, ':biography', $heroBiography);
    ajouterParamPDO($cur, ':pv', $heroPv);
    ajouterParamPDO($cur, ':mana', $heroMana);
    ajouterParamPDO($cur, ':strength', $heroStrength);
    ajouterParamPDO($cur, ':initiative', $heroInitiative);
    // ajouterParamPDO($cur, ':armor', $heroArmor);
    // ajouterParamPDO($cur, ':primary_weapon', $heroPrimary);
    // ajouterParamPDO($cur, ':secondary_weapon', $heroSecondary);
    // ajouterParamPDO($cur, ':shield', $heroShield);
    // ajouterParamPDO($cur, ':spell_list', $heroSpellList);
    ajouterParamPDO($cur, ':xp', $heroXp);
    ajouterParamPDO($cur, ':current_level', $heroCurrentLevel);

    $res = majDonneesPrepareesPDO($cur);

    header("Location: ../Chapter/1");
}

if ($mysqlClient) {
    creerClasse($mysqlClient);
}
?>
