<?php

include_once "../models/Hero.php";
include_once "../models/Monster.php";

class Combat
{

    private $hero;
    private $monster;
    private $round;
    private $isHeroTurn;
    private $mysqlClient;

    public function __construct($mysqlClient,$hero)
    {
        $this->hero = $hero;
        $monster = new Monster();

        $id = $hero->getHeroId();
        $sql = "SELECT monster_id,monster_name,monster_pv,monster_mana,monster_initiative,monster_strength,monster_attack,loot_id,monster_xp FROM MONSTER JOIN ENCOUNTER USING(monster_id) JOIN CHAPTER USING(chapter_id) JOIN QUEST USING(chapter_id) WHERE hero_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);
        $monster->firstMajFromPDO($mysqlClient,$donnee[0]["monster_id"]);

        $this->monster = $monster;
        $this->round = 1;
        $this->isHeroTurn = $this->getPriority();
        $this->mysqlClient = $mysqlClient;
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

    public function getRound(){
        return $this->round;
    }

    public function getIsHeroTurn(){
        return $this->isHeroTurn;
    }


public function getPriority() {

    $deHero = rand(1,6);
    $deAdversaire = rand(1,6);

    if($this->hero->getHeroInitiative()+$deHero > $this->monster->getMonsterInitiative() +$deAdversaire || ($this->hero->getHeroInitiative()+$deHero == $this->monster->getMonsterInitiative()+$deAdversaire && $this->hero->getClassId() == 2)) {
        return true;
    }

    else {
        //Donner priorité adversaire
        return false;
    }
}

public function performPhysicalAttack() {
    if($this->isHeroTurn) {
        $this->monster->takeDamage($mysqlClient,$this->hero->getPhysicDamage());
    }
    else {
        $this->hero->takeDamage($this->mysqlClient,$this->monster->getPhysicDamage());
    }
    $this->isHeroTurn = !$this->isHeroTurn;
    $this->round += 1;
}

public function performMagicalAttack($spell_id) {
    if($this->isHeroTurn) {
        $this->monster->takeDamage($this->hero->getMagicDamage($spell_id));
    }
    else {
        $this->hero->takeDamage($this->monster->getMagicDamage($spell_id));
    }
    $this->isHeroTurn = !$this->isHeroTurn;
    $this->round += 1;
}

public function consumePotion($items_id) {
    $this->hero->consumeAPotion($items_id);
    $this->isHeroTurn = !$this->isHeroTurn;
    $this->round += 1;
}

}
?>