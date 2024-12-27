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
    //En fonction du role sélectionné,on créé une instance de ce role.
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

    $image = null; // faire formulaire image

    //requete pour insérer dans la bdd un héro.
    $sql = "INSERT INTO Hero (user_id,hero_id,hero_name, class_id, hero_image, hero_biography,hero_pv, hero_mana, hero_strength,hero_initiative, hero_xp,hero_bourse_or, current_level) 
    VALUES (:user_id,:hero_id, :nom, :class_id, :image, :biography,:pv, :mana, :strength,:initiative, :xp,:bourseOr, :current_level)";


    $cur = preparerRequetePDO($mysqlClient, $sql);

    //les attibuts de notre instance héro
    $userId = $_SESSION['numero']; //user_id est initialisé avec le user_id de l'utilisateur connecté
    $hero_id = null; //hero_id = null car il y a une contraintes de clé primaire dans la bdd qui va l'incrémenter automatiquement
    $heroName = $nom; //$nom est le nom que l'utilisateur a fourni dans le formulaire.
    $heroClassId = $role->getClassId(); //On utilise notre objet class qui a pris tout les attributs de la classe de base du nouveau hero,classId ici
    $heroImage = $image; //$image est l'image que l'utilisateur a fourni dans le formulaire.
    $heroBiography = $biography; //$biography est la bio fourni par l'utilisateur dans le formulaire
    $heroPv = $role->getClassBasePv(); //Recupere les hp de base de la classe selectionné pour le héro
    $heroMana = $role->getClassBaseMana(); //Recupere le mana de base de la classe selectionné pour le héro
    $heroStrength = $role->getClassStrength(); //Recupere la force de base de la classe selectionné pour le héro
    $heroInitiative = $role->getClassInitiative();//recupere l'initiative de base de la classe selectionné pour le hero
    $heroBourseOr = 0; //Initialise la bourse d'or du nouveau hero à 0,vide.
    $heroXp = 0;//L'avancement de l'xp en cours est nul,le héro n'a encore rien accompli
    $heroCurrentLevel = 1; //Un héro commence toujours au niveau 1.
    
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
    $hero->firstMajFromPDO($mysqlClient,$id);
    $_SESSION['hero'] = $hero; //Nous mettons cet objet hero en variable de session,elle nous permettera d'acceder a cette variable partout ensuite.
}

if ($mysqlClient) {
    creerClasse($mysqlClient);
}
?>
