<?php
include_once "../models/connexionPDO.php";
include_once "../models/Hero.php";
include_once "../models/Monster.php";
include_once "../models/Combat.php";
session_start();

$combat = new Combat($mysqlClient,$_SESSION['hero']);



function fight($combat)
{
    while ($combat->getHero()->getHeroPv() > 0 && $combat->getMonster()->getMonsterPv() > 0) {
        echo "\nTour : {$combat->getRound()}\n";
        echo "Héros : " . $combat->getHero()->getHeroPv() . " PV\n";
        echo "Monstre : " . $combat->getMonster()->getMonsterPv() . " PV\n";

        // Si c'est le tour du héros
        if ($combat->getIsHeroTurn()) {
            echo "C'est le tour du héros.\n";
            echo "Quelle action voulez-vous effectuer ?\n";
            echo "1. Attaque physique\n";
            echo "2. Attaque magique\n";
            echo "3. Consommer une potion\n";

            $action = readline("Entrez votre choix (1-3) : ");

            switch ($action) {
                case 1:
                    $combat->performPhysicalAttack();
                    echo "Le héros inflige des dégâts physiques au monstre.\n";
                    break;
                case 2:
                    $spellId = readline("Entrez l'ID du sort magique : ");
                    $combat->performMagicalAttack($spellId);
                    echo "Le héros utilise un sort magique et inflige des dégâts au monstre.\n";
                    break;
                case 3:
                    $itemId = readline("Entrez l'ID de la potion à consommer : ");
                    $combat->consumePotion($itemId);
                    echo "Le héros consomme une potion et se soigne.\n";
                    break;
                default:
                    echo "Action invalide, vous perdez votre tour !\n";
            }
        } else {
            // Si c'est le tour du monstre
            echo "C'est le tour du monstre.\n";
            $combat->performPhysicalAttack(); // Le monstre attaque toujours physiquement dans cet exemple
            echo "Le monstre attaque et inflige des dégâts au héros.\n";
        }

        // Afficher les PV restants
        echo "Héros : " . $combat->hero->getHeroPv() . " PV\n";
        echo "Monstre : " . $combat->monster->getMonsterPv() . " PV\n";

    }

    // Déterminer le vainqueur
    if ($combat->getHero()->getHeroPv() <= 0) {
        echo "\nLe héros est vaincu. Le monstre gagne !\n";
    } elseif ($combat->getMonster()->getMonsterPv() <= 0) {
        echo "\nLe monstre est vaincu. Le héros gagne !\n";
    }
}

fight($combat);
?>