<?php
// Inclusion des classes nécessaires
include_once "../models/connexionPDO.php";
include_once "../models/Hero.php";
include_once "../models/Monster.php";
include_once "../models/Combat.php";
session_start();

// Initialiser le combat
$combat = new Combat($mysqlClient, $_SESSION['hero']);

// On utilise une boucle infinie pour simuler le combat
while ($combat->getHero()->getHeroPv() > 0 && $combat->getMonster()->getMonsterPv() > 0) {
    // Afficher l'état actuel du combat
    echo "<p>Héros : " . $combat->getHero()->getHeroPv() . " PV</p>";
    echo "<p>Monstre : " . $combat->getMonster()->getMonsterPv() . " PV</p>";
    echo "<p>Tour : " . $combat->getRound() . "</p>";

    // Action selon le tour
    if ($combat->getIsHeroTurn()) {
        $combat->performPhysicalAttack($mysqlClient);
        echo "<p>Le héros inflige des dégâts physiques au monstre.</p>";
    } else {
        $combat->performPhysicalAttack($mysqlClient);
        echo "<p>Le monstre inflige des dégâts physiques au héros.</p>";
    }

    // Pause de 2 secondes
    flush(); // Envoie la sortie au navigateur
    ob_flush();
    sleep(1); // Pause de 2 secondes

    // Vérification des points de vie pour terminer le combat
    if ($combat->getHero()->getHeroPv() <= 0) {
        echo "<p>Le héros a été vaincu.</p>";
        break;
    }

    if ($combat->getMonster()->getMonsterPv() <= 0) {
        echo "<p>Le monstre a été vaincu.</p>";
        break;
    }

    // Incrémentation du round
    $combat->setRound($combat->getRound()+1);

    // Changer de tour
    $combat->setIsHeroTurn(!$combat->getIsHeroTurn());
}

// Afficher le résultat final
echo "<p>Le combat est terminé !</p>";
?>
