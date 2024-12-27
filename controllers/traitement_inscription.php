<?php
session_start();

function afficherObj($obj)
{
    echo "<PRE>";
    print_r($obj);
    echo "</PRE>";
}

include_once "../models/connexionPDO.php";
include_once "../models/pdo_agile.php";


function inscription($mysqlClient)
{
    $erreur = 0;

    if (!empty($_POST["courriel"]) && !empty($_POST["mdp"]) && !empty($_POST["pseudo"])) {
        $courriel = $_POST["courriel"];
        $mdp = $_POST["mdp"];
        $pseudo = $_POST["pseudo"];
    } else {
        $erreur = 1; // Champs non remplis
    }

    if ($erreur == 0) {
        $sql = "SELECT * FROM USER WHERE user_mail = :courriel";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':courriel', $courriel, 'texte');
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);

        if ($res > 0) {
            $erreur = 2; // L'utilisateur existe déjà
        } else {
            $sqlInsert = "INSERT INTO USER (user_mail,user_pseudo,user_mdp) VALUES (:courriel,:pseudo,:mdp)";
            $curInsert = preparerRequetePDO($mysqlClient, $sqlInsert);
            ajouterParamPDO($curInsert, ':courriel', $courriel, 'texte');
            ajouterParamPDO($curInsert, ':pseudo', $pseudo, 'texte');
            ajouterParamPDO($curInsert, ':mdp', $mdp, 'texte');

            if (majDonneesPrepareesPDO($curInsert)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['courriel'] = $courriel;

                header("Location: ../views/formulaire_connexion.php");
                exit;
            } else {
                $erreur = 3; // Erreur lors de l'insertion
            }
        }
    }

    switch ($erreur) {
        case 1:
            echo "Veuillez remplir tous les champs.";
            break;
        case 2:
            echo "Un utilisateur avec ce courriel existe déjà.";
            break;
        case 3:
            echo "Erreur lors de l'inscription. Veuillez réessayer.";
            break;
        default:
            echo "Une erreur inattendue s'est produite.";
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $mysqlClient) {
    inscription($mysqlClient);
}
?>

