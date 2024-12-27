<?php
session_start();

function afficherObj($obj)
{
    echo "<PRE>";
    print_r($obj);
    echo "</PRE>";
}

include_once "../models/connexionPDO.php";
include_once "../models/Hero.php";

$_SESSION['loggedin'] = false;//un bool pour savoir si un utilisateur est id.
$_SESSION['numero'] = null; //Le numero du compte,côté bdd c'est user_id
$_SESSION['courriel'] = null; //Le mail du compte
$_SESSION['hero'] = new Hero(); //On instancie un hero ou tout les attributs sont nuls pour l'instant



function connexion($mysqlClient)
{
    $erreur = 0;

    if (!empty($_POST["courriel"]) && !empty($_POST["mdp"])) { //verification que les champs du formulaire ne sont pas vides
        $courriel = $_POST["courriel"];
        $mdp = $_POST["mdp"];
    } else {
        $erreur = 1; // Les champs ne sont pas remplis
    }

    if ($erreur == 0) {
        $sql = "SELECT user_mdp FROM USER WHERE user_mail = :courriel"; //requete sql permettant de trouver le mdp de l'utilisateur pour un email donner
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':courriel', $courriel, 'texte');
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);

        if ($res == 0) { //permet aussi de verifier avec le nb de lignes retournées si un utilisateur avec cet email existe.
            $erreur = 2; // L'utilisateur n'existe pas.
        } else {
            if (isset($donnee[0])) {
                if ($mdp != $donnee[0]["user_mdp"]) { //Verification que le mdp est le même que celui associé au compte
                    $erreur = 3; // mdp incorrect
                } else { //si toutes les conditions sont passées:
                    $_SESSION['loggedin'] = true; //nous mettons le bool loggedin a true
                    $_SESSION['courriel'] = $courriel; //Nous fournissons le courriel du compte dans la variable de session

                    $sql = "SELECT user_id FROM USER WHERE user_mail = :courriel"; //requete afin de recuperer le user_id a partir du courriel du compte
                    $cur = preparerRequetePDO($mysqlClient, $sql);
                    ajouterParamPDO($cur, ':courriel', $courriel, 'texte');
                    $donnee = [];
                    $res = LireDonneesPDOPreparee($cur, $donnee);
                    if ($res > 0) {
                        $_SESSION['numero'] = $donnee[0]["user_id"];//nous fournissons le user_id dans la variable de session numero.
                    }

                    // Check if user is an admin (if needed)
                    /* $sql = "SELECT admin_id FROM ADMINS WHERE user_mail = :courriel";
                    $cur = preparerRequetePDO($mysqlClient, $sql);
                    ajouterParamPDO($cur, ':courriel', $courriel, 'texte');
                    $donnee = [];
                    $res = LireDonneesPDOPreparee($cur, $donnee);
                    if ($res > 0) {
                        $_SESSION['isAdmin'] = true;
                    } */
                }
            }
        }
    }

    switch ($erreur) { //switch pour la gestion des erreurs.
        case 0:
            // Succes de la connexion
            echo "ok";
            echo $_SESSION['loggedin'];
            echo $_SESSION['numero'];
            echo $_SESSION['courriel'];


                    $sql = "SELECT * FROM HERO WHERE user_id = :id"; //Nous cherchons si l'utilisateur possede deja un hero
                    $cur = preparerRequetePDO($mysqlClient, $sql);
                    ajouterParamPDO($cur, ':id', $_SESSION['numero']);
                    $donnee = [];
                    $res = LireDonneesPDOPreparee($cur, $donnee);
                    if ($res > 0) {
                        $_SESSION['hero']->hydrate($donnee[0]);
                    }

            var_dump($_SESSION['hero']);
            break;

        case 1:
            echo "Please fill in all fields.";
            break;

        case 2:
            echo "User does not exist in the database.";
            break;

        case 3:
            echo "Incorrect password.";
            break;

        default:
            echo "<script type='text/javascript'>
                    alert('Email or password is incorrect');
                    window.location.href = '../index.php';
                </script>";
            break;
    }
}

if ($mysqlClient) {
    connexion($mysqlClient);
}
?>