<?php

include_once "../models/Classe.php";
include_once "../models/Hero.php";

function getPriorite($hero,$adversaire) {

    $deHero = rand(1,6);
    $deAdversaire = rand(1,6);

    if($hero->getInitiave()+$deHero > $adversaire->getInitiative() +$deAdversaire || ($hero->getInitiave()+$deHero == $adversaire->getInitiative()+$deAdversaire && $hero->getClassId() == 2)) {
        return true;
    }

    else {
        //Donner priorité adversaire
        return false;
    }
}

function doAttaquePhysique($attaquant,$defenseur) {

    $deAttaque = rand(1,6);
    $deDefenseur = rand(1,6);
    $bonus_arme = 0;
    $bonus_armure;

    if($attaquant instanceof Hero) {
        //$bonus_arme 
        // augmenter bonus_arme grace aux armes de hero.
    }

    if($defenseur instanceof Hero) {
        //$bonus_armure 
        // augmenter bonus_armure grace aux armure de hero.
    }

    if(($attaquant->getStrength() + $bonus_arme + $deAttaque) - (int)($defenseur->getStrength()/2) + $bonus_armure + $deDefenseur)
}
?>