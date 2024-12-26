<?php

include_once "../models/connexionPDO.php";

// models/Monster.php

class Monster
{
    protected $monster_id;
    protected $monster_name;
    protected $monster_pv;
    protected $monster_mana;
    protected $monster_initiative;
    protected $monster_strength;
    protected $monster_attack;
    protected $loot_id;
    protected $monster_xp;

    public function __construct()
    {
        $this->monster_id = null;
        $this->monster_name = null;
        $this->monster_pv = null;
        $this->monster_mana = null;
        $this->monster_initiative = null;
        $this->monster_strength = null;
        $this->monster_attack = null;
        $this->loot_id = null;
        $this->monster_xp = null;
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

    public function firstMajFromPDO($mysqlClient,$id) {
        $sql = "SELECT * FROM MONSTER WHERE monster_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);
        $this->hydrate($donnee[0]);
    }

    public function majFromPDO($mysqlClient) {
        $id = $this->monster_id;
        $sql = "SELECT * FROM MONSTER WHERE monster_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);
        $this->hydrate($donnee[0]);
    }

    public function getPhysicDamage() {
        $deAttaque = rand(1,6);
        $id = $this->monster_id;

        return $this->monster_strength + $deAttaque;
    }

    public function canThisSpell($spell_id) {
        $id = $this->monster_id;
        $sql = "SELECT SPELL_COST FROM SPELL JOIN SPELLLISTMONSTER USING(SPELL_ID) JOIN MONSTER USING(MONSTER_ID) WHERE monster_id = :id and SPELL_ID = :id_spell and (monster_mana-spell_cost) > 0";
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
        $id = $this->monster_id;
        $cost = canThisSpell($spell_id);

        $sql = "UPDATE MONSTER SET MONSTER_MANA -= :cost WHERE monster_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':cost', $cost);
        $donnee = [];
        $res = majDonneesPrepareesTabPDO($cur, $donnee);

        $this->monster_mana -= $cost;

        return $deAttaque1 + $deAttaque2 + $cost;
    }

    public function takeDamage($mysqlClient,$damage)
    {
        $deDefenseur = rand(1,6);
        $id = $this->monster_id;
        $diff = max(0,$damage - ($this->monster_strength/2 + $deDefenseur));

        $sql = "UPDATE MONSTER SET MONSTER_PV -= :diff WHERE monster_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':diff', $diff);
        $donnee = [];
        $res1 = majDonneesPrepareesTabPDO($cur, $donnee);

        $this->monster_pv -= $diff;
    }

    // Getters et Setters
    public function getMonsterId()
    {
        return $this->monster_id;
    }

    public function setMonsterId($monster_id): self
    {
        $this->monster_id = $monster_id;
        return $this;
    }

    public function getMonsterName()
    {
        return $this->monster_name;
    }

    public function setMonsterName($monster_name): self
    {
        $this->monster_name = $monster_name;
        return $this;
    }

    public function getMonsterPv()
    {
        return $this->monster_pv;
    }

    public function setMonsterPv($monster_pv): self
    {
        $this->monster_pv = $monster_pv;
        return $this;
    }

    public function getMonsterMana()
    {
        return $this->monster_mana;
    }

    public function setMonsterMana($monster_mana): self
    {
        $this->monster_mana = $monster_mana;
        return $this;
    }

    public function getMonsterInitiative()
    {
        return $this->monster_initiative;
    }

    public function setMonsterInitiative($monster_initiative): self
    {
        $this->monster_initiative = $monster_initiative;
        return $this;
    }

    public function getMonsterStrength()
    {
        return $this->monster_strength;
    }

    public function setMonsterStrength($monster_strength): self
    {
        $this->monster_strength = $monster_strength;
        return $this;
    }

    public function getMonsterAttack()
    {
        return $this->monster_attack;
    }

    public function setMonsterAttack($monster_attack): self
    {
        $this->monster_attack = $monster_attack;
        return $this;
    }

    public function getLootId()
    {
        return $this->$loot_id;
    }

    public function setLootId($loot_id): self
    {
        $this->loot_id= $loot_id;
        return $this;
    }

    public function getMonsterXp()
    {
        return $this->$monster_xp;
    }

    public function setMonsterXp($monster_xp): self
    {
        $this->monster_xp= $monster_xp;
        return $this;
    }
}
