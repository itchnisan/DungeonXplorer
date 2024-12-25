<?php

include_once "../models/Classe.php";
include_once "../models/Hero.php";

class Combat
{

    private $hero;
    private $monstre;

    public function __construct()
    {
        $this->hero = null;
        $this->monstre = null;
    }

     // Méthode hydrate
     public function hydrate(array $donnees)
     {
         foreach ($donnees as $key => $value) {
             $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
 
             if (method_exists($this, $method)) {
                 $this->$method($value);
             }
         }
     }

      // Getters et Setters
    public function getHero()
    {
        return $this->hero;
    }

    public function setHero($hero): self
    {
        $this->hero = $hero;
        return $this;
    }

    public function getMonster()
    {
        return $this->monster;
    }

    public function setMonster($monster): self
    {
        $this->monster = $monster;
        return $this;
    }


function getPriorite() {

    $deHero = rand(1,6);
    $deAdversaire = rand(1,6);

    if($this->hero->getInitiave()+$deHero > $this->monster->getInitiative() +$deAdversaire || ($this->hero->getInitiave()+$deHero == $this->monster->getInitiative()+$deAdversaire && $this->hero->getClassId() == 2)) {
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
    $bonus_armure = 0;

    if($attaquant instanceof Hero) {
        //$bonus_arme 
        // augmenter bonus_arme grace aux armes de hero.
        $id = $attaquant->getHeroId();
        $id_type = 1;
        $sql = "SELECT ITEMS_ATTACK FROM ITEMS JOIN TYPEEQUIPMENT USING(ITEMS_ID) JOIN EQUIPMENT USING(ITEMS_ID) WHERE hero_id = :id and TYPEEQUIPMENT_TYPE = :id_type";
                        $cur = preparerRequetePDO($mysqlClient, $sql);
                        ajouterParamPDO($cur, ':id', $id);
                        ajouterParamPDO($cur, ':id_type', $id_type);
                        $donnee = [];
                        $res2 = LireDonneesPDOPreparee($cur, $donnee);

                        if($res2 > 0) {
                            $bonus_arme = $donnee[0]["items_attack"];
                        }
    }

    if($defenseur instanceof Hero) {
        //$bonus_armure 
        // augmenter bonus_armure grace aux armure de hero.
        $id = $defenseur->getHeroId();
        $id_type = 2;
        $sql = "SELECT ITEMS_PROTECTION FROM ITEMS JOIN TYPEEQUIPMENT USING(ITEMS_ID) JOIN EQUIPMENT USING(ITEMS_ID) WHERE hero_id = :id and TYPEEQUIPMENT_TYPE = :id_type";
                        $cur = preparerRequetePDO($mysqlClient, $sql);
                        ajouterParamPDO($cur, ':id', $id);
                        ajouterParamPDO($cur, ':id_type', $id_type);
                        $donnee = [];
                        $res2 = LireDonneesPDOPreparee($cur, $donnee);

                        if($res2 > 0) {
                            $bonus_armure = $donnee[0]["items_protection"];
                        }
    }

    if($defenseur instanceof Voleur) {
        $diff = max(0,($attaquant->getStrength() + $bonus_arme + $deAttaque) - ($defenseur->getInitiative()/2 + $bonus_armure + $deDefenseur));
    }
    else {
    $diff = max(0,($attaquant->getStrength() + $bonus_arme + $deAttaque) - ($defenseur->getStrength()/2 + $bonus_armure + $deDefenseur));
    }
    
    $defenseur = $diff;
}
}
?>