<?php
session_start();

include_once "../models/connexionPDO.php";
include_once "../models/Classe.php";
include_once "../models/Hero.php";
include_once "../models/Combat.php";

function combattre1Tour($adversaire) {

    if(getPriorite($_SESSION['hero'],$adversaire)) {

    }
    else {
        
    }
}
?>