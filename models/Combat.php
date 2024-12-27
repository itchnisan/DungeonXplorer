<?php
include_once "Hero.php";
include_once "Monster.php";

//Attributs de la classe
class Combat
{

    private $hero;
    private $monster;
    private $round;
    private $isHeroTurn;
    private $mysqlClient;

    //Constructeur de la classe qui prend en parametre un hero.
    public function __construct($mysqlClient,$hero) {
        $this->hero = $hero;
        $monster = new Monster();

        $id = $hero->getHeroId();
        echo $id;
        
        $sql = "select monster_id,monster_name,monster_pv,monster_mana,monster_initiative,monster_strength,monster_attack,monster_xp from quest
                JOIN encounter USING (chapter_id)
                JOIN monster USING (monster_id)
                where hero_id = :id";

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

      // Getters et Setters
    public function getHero() {
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

    public function setRound($number): self
    {
        $this->round = $number;
        return $this;
    }

    public function getRound(){
        return $this->round;
    }

    public function getIsHeroTurn(){
        return $this->isHeroTurn;
    }

    public function setIsHeroTurn($bool): self
    {
        $this->isHeroTurn = $bool;
        return $this;
    }


//Fonction permettant de savoir qui a la priorite au debut du combat grâce aux calculs donnés par le sujet
//renvoie true si c'est le hero qui a la priorite, false sinon
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

//Fonction permettant d'effectuer une attaque physique
//utilise les fonctions des classes hero et monstre
public function performPhysicalAttack($mysqlClient) {
    if ($this->isHeroTurn) { // si c'est le tour du hero c'est le monstre qui subit les damage
        $this->monster->takeDamage($mysqlClient, $this->hero->getPhysicDamage($mysqlClient));
    } else { //c'est le hero sinon.
        $this->hero->takeDamage($this->mysqlClient, $this->monster->getPhysicDamage($mysqlClient));
    }
}

//Fonction permettant d'effectuer une attaque physique
//utilise les fonctions des classes hero et monstre
public function performMagicalAttack($mysqlClient, $spell_id) {
    if ($this->isHeroTurn) {
        $this->monster->takeDamage($this->hero->getMagicDamage($mysqlClient, $spell_id));
    } else { // c'est le hero sinon.
        $this->hero->takeDamage($this->monster->getMagicDamage($mysqlClient, $spell_id));
    }
}

//Fonction permettant d'effectuer la consommation d'une potion.
public function consumePotion($mysqlClient, $items_id) {
    $this->hero->consumeAPotion($mysqlClient, $items_id);
}


}
?>