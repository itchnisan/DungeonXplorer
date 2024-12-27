<?php

include_once "../models/connexionPDO.php";

// models/Monster.php

//Attributs de la class
class Monster
{
    protected $monster_id;
    protected $monster_name;
    protected $monster_pv;
    protected $monster_mana;
    protected $monster_initiative;
    protected $monster_strength;
    protected $monster_attack;
    protected $monster_xp;

    // Constructeur : Initialise les attributs à null par défaut.
    public function __construct()
    {
        $this->monster_id = null;
        $this->monster_name = null;
        $this->monster_pv = null;
        $this->monster_mana = null;
        $this->monster_initiative = null;
        $this->monster_strength = null;
        $this->monster_attack = null;
        $this->monster_xp = null;
    }

    // Méthode hydrate
    // Méthode permettant de remplir les attributs de l'objet à partir d'un tableau associatif.
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // Génère le nom du setter correspondant à l'attribut (ex: setMonsterId).
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            // Si la méthode existe, l'appelle avec la valeur correspondante.
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Charge les données du monstre depuis la base de données lors de sa première initialisation.
    public function firstMajFromPDO($mysqlClient,$id) {
        // Requête pour récupérer les informations du monstre par son ID.
        $sql = "SELECT * FROM MONSTER WHERE monster_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);
        // Hydrate l'objet avec les données récupérées.
        $this->hydrate($donnee[0]);
    }

    // Met à jour les données du monstre localement en rechargeant les informations depuis la base.
    public function majFromPDO($mysqlClient) {
        $id = $this->monster_id;
        $sql = "SELECT * FROM MONSTER WHERE monster_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);
        $this->hydrate($donnee[0]);
    }

    // fonction qui retourne le montant des dégats que pourrait infliger une attaque physique de ce monstre.
    public function getPhysicDamage() {
        $deAttaque = rand(1,6);
        $id = $this->monster_id;

        return $this->monster_strength + $deAttaque;
    }

    //Fonction permettant de savoir si le spell ($spell_id) peut etre lancé par le mana actuel.
    //return le cout du spell si possible,-1 sinon
    public function canThisSpell($spell_id) {
        $id = $this->monster_id;
        //requete sql recuperant le cout de mana
        $sql = "SELECT SPELL_COST FROM SPELL JOIN SPELLLISTMONSTER USING(SPELL_ID) JOIN MONSTER USING(MONSTER_ID) WHERE monster_id = :id and SPELL_ID = :id_spell and (monster_mana-spell_cost) > 0";
                            $cur = preparerRequetePDO($mysqlClient, $sql);
                            ajouterParamPDO($cur, ':id', $id);
                            ajouterParamPDO($cur, ':id_spell', $spell_id);
                            $donnee = [];
                            $res = LireDonneesPDOPreparee($cur, $donnee);
    
                            //Si il y a au moins une reponse, alors on peut lancer le spell
                            if($res > 0) {
                                return $donnee[0]["spell_cost"];
                            }
        else {
            return -1;
        }
    }

    //Fonction qui retourne le montant des dégats magiques que pourrait infliger une attaque magique de ce mosntre.
    public function getMagicDamage($spell_id) {
        $deAttaque1 = rand(1,6);
        $deAttaque2 = rand(1,6);
        $id = $this->monster_id;
        $cost = canThisSpell($spell_id); // recuperation du cout de mana,la verification se fera sur le controller

        //requete permettant de mettre a jour le mana du monstre apres utilisation.
        $sql = "UPDATE MONSTER SET MONSTER_MANA = MONSTER__MANA - :cost WHERE monster_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':cost', $cost);
        $donnee = [];
        $res = majDonneesPrepareesTabPDO($cur, $donnee);

        $this->monster_mana -= $cost;

        return $deAttaque1 + $deAttaque2 + $cost;
    }

    //fonction qui met a jour les pv du monstre apres avoir subit les degats mis en parametre auxquels on soustrait la defense du monstre
    public function takeDamage($mysqlClient, $damage)
{
    $deDefenseur = rand(1, 6);
    $id = $this->monster_id;
    $diff = max(0, $damage - ($this->monster_strength / 2 + $deDefenseur)); //soustraction des degats apres calcul de la defense

    //requete mettant a jour les pv du monstre dans la base.
    $sql = "UPDATE MONSTER SET MONSTER_PV = MONSTER_PV - :diff WHERE monster_id = :id";
    
    // Préparer la requête
    $cur = preparerRequetePDO($mysqlClient, $sql);

    // Ajouter les paramètres
    ajouterParamPDO($cur, ':id', $id, 'nombre');
    ajouterParamPDO($cur, ':diff', $diff, 'nombre');
    
    // Exécution de la requête et gestion des erreurs
    $res = $cur->execute();

    if (!$res) {
        // Si la requête échoue, afficher l'erreur PDO
        echo "Erreur d'exécution SQL : " . implode(", ", $cur->errorInfo());
    } else {
        echo "Mise à jour réussie. Dégâts infligés : " . $diff . " points.\n";
    }

    // Mise à jour des PV du monstre localement
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
