<?php
session_start();

function afficherObj($obj)
{
    echo "<PRE>";
    print_r($obj);
    echo "</PRE>";
}

include_once "../models/connexionPDO.php";


$_SESSION['loggedin'] = false;
$_SESSION['isAdmin'] = false;
$_SESSION['numero'] = null;
$_SESSION['courriel'] = null;
$_SESSION['hero'] = null;
$_SESSION['spellList'] = null;
$_SESSION['equipments'] = null;

function connexion($mysqlClient)
{
    $erreur = 0;

    if (!empty($_POST["courriel"]) && !empty($_POST["mdp"])) {
        $courriel = $_POST["courriel"];
        $mdp = $_POST["mdp"];
    } else {
        $erreur = 1; // Fields are not filled
    }

    if ($erreur == 0) {
        $sql = "SELECT * FROM USER WHERE user_mail = :courriel";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':courriel', $courriel, 'texte');
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);

        if ($res == 0) {
            $erreur = 2; // User doesn't exist
        } else {
            if (isset($donnee[0])) {
                if ($mdp != $donnee[0]["user_mdp"]) {
                    $erreur = 3; // Incorrect password
                } else {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['courriel'] = $courriel;
                    echo $courriel;
                    echo $_SESSION['courriel'];
                    /*
                    $sql = "SELECT hero_id FROM USER WHERE user_mail = :courriel";
                    $cur = preparerRequetePDO($mysqlClient, $sql);
                    ajouterParamPDO($cur, ':courriel', $courriel, 'texte');
                    $donnee = [];
                    $res = LireDonneesPDOPreparee($cur, $donnee);
                    if ($res > 0) {
                        $_SESSION['numero'] = $donnee[0]["hero_id"];
                    }
                    */
                    
                    $_SESSION['numero'] = $donnee[0]['user_id'];

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

    switch ($erreur) {
        case 0:
            // Successfully logged in
            echo "ok";
            echo $_SESSION['loggedin'];
            echo $_SESSION['isAdmin'];
            echo $_SESSION['numero'];
            echo $_SESSION['courriel'];
            echo $_SESSION['numero'];
            //redirection vers page acceuil
            header("Location: ../views/formulaire_classe.php");
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