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
include_once "../models/SpellList.php";
include_once "../models/Equipment.php";

$_SESSION['loggedin'] = false;
//$_SESSION['isAdmin'] = false;
$_SESSION['numero'] = null;
$_SESSION['courriel'] = null;
$_SESSION['hero'] = new Hero();
$_SESSION['spellList'] = new SpellList();
$_SESSION['equipment'] = new Equipment();


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
        $sql = "SELECT user_mdp FROM USER WHERE user_mail = :courriel";
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

                    $sql = "SELECT user_id FROM USER WHERE user_mail = :courriel";
                    $cur = preparerRequetePDO($mysqlClient, $sql);
                    ajouterParamPDO($cur, ':courriel', $courriel, 'texte');
                    $donnee = [];
                    $res = LireDonneesPDOPreparee($cur, $donnee);
                    if ($res > 0) {
                        $_SESSION['numero'] = $donnee[0]["user_id"];
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

    switch ($erreur) {
        case 0:
            // Successfully logged in
            echo "ok";
            echo $_SESSION['loggedin'];
            //echo $_SESSION['isAdmin'];
            echo $_SESSION['numero'];
            echo $_SESSION['courriel'];


                    $sql = "SELECT * FROM HERO WHERE user_id = :id";
                    $cur = preparerRequetePDO($mysqlClient, $sql);
                    ajouterParamPDO($cur, ':id', $_SESSION['numero']);
                    $donnee = [];
                    $res = LireDonneesPDOPreparee($cur, $donnee);
                    if ($res > 0) {
                        $_SESSION['hero']->hydrate($donnee[0]);

                        $id = $_SESSION['hero']->getHeroId();

                        $sql = "SELECT * FROM SPELLLIST WHERE hero_id = :id";
                        $cur = preparerRequetePDO($mysqlClient, $sql);
                        ajouterParamPDO($cur, ':id', $id);
                        $donnee = [];
                        $res2 = LireDonneesPDOPreparee($cur, $donnee);

                        if($res2 > 0) {
                            $_SESSION['spellList']->hydrate($donnee[0]);
                        }
                        $sql = "SELECT * FROM EQUIPMENT WHERE hero_id = :id";
                        $cur = preparerRequetePDO($mysqlClient, $sql);
                        ajouterParamPDO($cur, ':id', $id);
                        $donnee = [];
                        $res2 = LireDonneesPDOPreparee($cur, $donnee);

                        if($res2 > 0) {
                            $_SESSION['equipment']->hydrate($donnee[0]);
                        }
                    }

            var_dump($_SESSION['hero']);
            var_dump($_SESSION['spellList']);
            var_dump($_SESSION['equipment']);

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