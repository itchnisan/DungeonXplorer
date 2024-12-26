<?php

include_once "../models/connexionPDO.php";

class Hero
{
    protected $hero_id;
    protected $user_id;
    protected $hero_name;
    protected $class_id;
    protected $hero_image;
    protected $hero_biography;
    protected $hero_pv;
    protected $hero_mana;
    protected $hero_strength;
    protected $hero_initiative;
    protected $hero_bourse;
    protected $hero_xp;
    protected $current_level;

    public function __construct()
    {
        $this->hero_id = null;
        $this->user_id = null;
        $this->hero_name = null;
        $this->class_id = null;
        $this->hero_image = null;
        $this->hero_biography = null;
        $this->hero_pv = null;
        $this->hero_mana = null;
        $this->hero_strength = null;
        $this->hero_initiative = null;
        $this->hero_bourse = null;
        $this->hero_xp = null;
        $this->current_level = null;
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

    public function firstMajFromPDO($id) {
        $sql = "SELECT * FROM HERO WHERE user_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);
        $this->hydrate($donnee[0]);
    }

    public function majFromPDO() {
        $id = $this->hero_id;
        $sql = "SELECT * FROM HERO WHERE user_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);
        $this->hydrate($donnee[0]);
    }

    public function getPhysicDamage() {
        $deAttaque = rand(1,6);
        $bonus_arme = 0;
        $id = $this->hero_id;
        $id_type = 1;

        $sql = "SELECT ITEMS_EFFICIENCY FROM ITEMS JOIN TYPEEQUIPMENT USING(ITEMS_ID) JOIN EQUIPMENT USING(ITEMS_ID) WHERE hero_id = :id and TYPEEQUIPMENT_TYPE = :id_type";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':id_type', $id_type);
        $donnee = [];
        $res2 = LireDonneesPDOPreparee($cur, $donnee);

        if($res2 > 0) {
        $bonus_arme = $donnee[0]["ITEMS_EFFICIENCY"];
        }

        return $this->hero_strength + $bonus_arme + $deAttaque;
    }

    public function canThisSpell($spell_id) {
        $id = $this->hero_id;
        $sql = "SELECT SPELL_COST FROM SPELL JOIN SPELLLIST USING(SPELL_ID) JOIN HERO USING(HERO_ID) WHERE hero_id = :id and SPELL_ID = :id_spell and (hero_mana-spell_cost) > 0";
                            $cur = preparerRequetePDO($mysqlClient, $sql);
                            ajouterParamPDO($cur, ':id', $id);
                            ajouterParamPDO($cur, ':id_spell', $spell_id);
                            $donnee = [];
                            $res = LireDonneesPDOPreparee($cur, $donnee);
    
                            if($res > 0) {
                                return $donnee[0]["spell_cost"];
                            }
        else {
            return -1;
        }
    }

    public function getMagicDamage($spell_id) {
        $deAttaque1 = rand(1,6);
        $deAttaque2 = rand(1,6);
        $id = $this->hero_id;
        $cost = canThisSpell($spell_id);

        $sql = "UPDATE HERO SET HERO_MANA -= :cost WHERE hero_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':cost', $cost);
        $donnee = [];
        $res = majDonneesPrepareesTabPDO($cur, $donnee);

        $this->hero_mana -= $cost;

        return $deAttaque1 + $deAttaque2 + $cost;
    }

    public function takeDamage($mysqlClient,$damage)
    {
        $deDefenseur = rand(1,6);
        $bonus_armure = 0;
        $id = $this->hero_id;
        $idItemType = 2;

        $sql = "SELECT ITEMS_EFFICIENCY FROM ITEMS JOIN TYPEEQUIPMENT USING(ITEMS_ID) JOIN EQUIPMENT USING(ITEMS_ID) WHERE hero_id = :id and TYPEEQUIPMENT_TYPE = :id_type";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':id_type', $idItemType);
        $donnee = [];
        $res2 = LireDonneesPDOPreparee($cur, $donnee);

        if($res2 > 0) {
            $bonus_armure = $donnee[0]["ITEMS_EFFICIENCY"];
        }

        if($this->classe_id == 2) {
            $diff = max(0,$damage - ($this->hero_initiative/2 + $bonus_armure + $deDefenseur));
        }
        else {
            $diff = max(0,$damage - ($this->hero_strength/2 + $bonus_armure + $deDefenseur));
        }

        $sql = "UPDATE HERO SET HERO_PV -= :diff WHERE hero_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':diff', $diff);
        $donnee = [];
        $res1 = majDonneesPrepareesTabPDO($cur, $donnee);
        $this->hero_pv -= $diff;
    }

    public function itemInInventory($items_id) {
        $sql = "SELECT * FROM ITEMS JOIN INVENTORY USING(ITEMS_ID) JOIN HERO USING(HERO_ID) WHERE items_id = :items_id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':items_id', $items_id);
        $donnee = [];
        $res2 = LireDonneesPDOPreparee($cur, $donnee);

        if($res2 > 0) {
            return true;
        }
        return false;
    }

    public function consumeAPotion($items_id) {
        $efficiency = 0;
        $amount = 0;

        if(itemInInventory($items_id)) {
        $sql = "SELECT ITEMS_EFFICIENCY FROM ITEMS WHERE items_id = :items_id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':items_id', $items_id);
        $donnee = [];
        $res2 = LireDonneesPDOPreparee($cur, $donnee);

        $efficiency = $donnee[0]["ITEMS_EFFICIENCY"];

            $id = $this->hero_id;
            $sql = "SELECT ITEMS_AMOUNT FROM INVENTORY WHERE hero_id = :id AND items_id = :items_id";
            $cur = preparerRequetePDO($mysqlClient, $sql);
            ajouterParamPDO($cur, ':items_id', $items_id);
            ajouterParamPDO($cur, ':id', $id);
            $donnee = [];
            $res2 = LireDonneesPDOPreparee($cur, $donnee);
            
            $amount = $donnee[0]["ITEMS_AMOUNT"];

            $amount -= 1;

            if($amount > 0) {
            $sql = "UPDATE INVENTORY SET ITEMS_AMOUNT = :amount WHERE hero_id = :id";
            $cur = preparerRequetePDO($mysqlClient, $sql);
            ajouterParamPDO($cur, ':id', $id);
            ajouterParamPDO($cur, ':amount', $amount);
            $donnee = [];
            $res1 = majDonneesPrepareesTabPDO($cur, $donnee);
            }

            else {
                $sql = "DELETE FROM INVENTORY WHERE hero_id = :id";
                $cur = preparerRequetePDO($mysqlClient, $sql);
                ajouterParamPDO($cur, ':id', $id);
                $donnee = [];
                $res1 = majDonneesPrepareesTabPDO($cur, $donnee);
            }

            if($items_id == 5) {
                $sql = "UPDATE HERO SET HERO_PV += :efficiency WHERE hero_id = :id";
                $cur = preparerRequetePDO($mysqlClient, $sql);
                ajouterParamPDO($cur, ':id', $id);
                ajouterParamPDO($cur, ':efficiency', $efficiency);
                $donnee = [];
                $res1 = majDonneesPrepareesTabPDO($cur, $donnee);

                $this->hero_pv+=$efficiency;
            }
            else {
                $sql = "UPDATE HERO SET HERO_MANA += :efficiency WHERE hero_id = :id";
                $cur = preparerRequetePDO($mysqlClient, $sql);
                ajouterParamPDO($cur, ':id', $id);
                ajouterParamPDO($cur, ':efficiency', $efficiency);
                $donnee = [];
                $res1 = majDonneesPrepareesTabPDO($cur, $donnee);
                $this->hero_mana+=$efficiency;
            }
        }
        
    }

    public function isAlive()
    {
        return $this->hero_pv > 0;
    }

    // Getters et Setters
    public function getHeroId()
    {
        return $this->hero_id;
    }

    public function setHeroId($hero_id): self
    {
        $this->hero_id = $hero_id;
        return $this;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getHeroName()
    {
        return $this->hero_name;
    }

    public function setHeroName($hero_name): self
    {
        $this->hero_name = $hero_name;
        return $this;
    }

    public function getClassId()
    {
        return $this->class_id;
    }

    public function setClassId($class_id): self
    {
        $this->class_id = $class_id;
        return $this;
    }

    public function getHeroImage()
    {
        return $this->hero_image;
    }

    public function setHeroImage($hero_image): self
    {
        $this->hero_image = $hero_image;
        return $this;
    }

    public function getHeroBiography()
    {
        return $this->hero_biography;
    }

    public function setHeroBiography($hero_biography): self
    {
        $this->hero_biography = $hero_biography;
        return $this;
    }

    public function getHeroPv()
    {
        return $this->hero_pv;
    }

    public function setHeroPv($hero_pv): self
    {
        $this->hero_pv = $hero_pv;
        return $this;
    }

    public function getHeroMana()
    {
        return $this->hero_mana;
    }

    public function setHeroMana($hero_mana): self
    {
        $this->hero_mana = $hero_mana;
        return $this;
    }

    public function getHeroStrength()
    {
        return $this->hero_strength;
    }

    public function setHeroStrength($hero_strength): self
    {
        $this->hero_strength = $hero_strength;
        return $this;
    }

    public function getHeroInitiative()
    {
        return $this->hero_initiative;
    }

    public function setHeroInitiative($hero_initiative): self
    {
        $this->hero_initiative = $hero_initiative;
        return $this;
    }

    public function getHeroBourse()
    {
        return $this->hero_bourse;
    }

    public function setHeroBourse($hero_bourse): self
    {
        $this->hero_bourse = $hero_bourse;
        return $this;
    }

    public function getHeroXp()
    {
        return $this->hero_xp;
    }

    public function setHeroXp($hero_xp): self
    {
        $this->hero_xp = $hero_xp;
        return $this;
    }

    public function getCurrentLevel()
    {
        return $this->current_level;
    }

    public function setCurrentLevel($current_level): self
    {
        $this->current_level = $current_level;
        return $this;
    }
}
