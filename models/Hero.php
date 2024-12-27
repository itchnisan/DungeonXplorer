<?php

include_once "../models/connexionPDO.php";

//Attributs de la class
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

    // Constructeur : Initialise les attributs à null par défaut.
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

    // Charge les données du hero depuis la base de données lors de sa première initialisation.
    public function firstMajFromPDO($mysqlClient,$id) {
        // Requête pour récupérer les informations du hero par son ID.
        $sql = "SELECT * FROM HERO WHERE user_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);
        // Hydrate l'objet avec les données récupérées.
        $this->hydrate($donnee[0]);
    }

    // Met à jour les données du hero localement en rechargeant les informations depuis la base.
    public function majFromPDO($mysqlClient) {
        $id = $this->hero_id;
        $sql = "SELECT * FROM HERO WHERE user_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);
        $this->hydrate($donnee[0]);
    }

    // fonction qui retourne le montant des dégats que pourrait infliger une attaque physique de cet hero.
    public function getPhysicDamage($mysqlClient) {
        $deAttaque = rand(1,6);
        $bonus_arme = 0; //initialisation du bonus arme a 0
        $id = $this->hero_id;
        $id_type = 1;
        //requete pour recuperer le bonus que confere l'arme equipe par le hero.
        $sql = "SELECT ITEMS_EFFICIENCY FROM ITEMS JOIN TYPEEQUIPMENT USING(ITEMS_ID) JOIN EQUIPMENT USING(ITEMS_ID) WHERE hero_id = :id and TYPEEQUIPMENT_TYPE = :id_type";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':id_type', $id_type);
        $donnee = [];
        $res2 = LireDonneesPDOPreparee($cur, $donnee);

        if($res2 > 0) {
        $bonus_arme = $donnee[0]["ITEMS_EFFICIENCY"]; // si le hero a bien équipé une arme alors on ajoute son bonus pour l'jouter au calcul total des degats.
        }

        return $this->hero_strength + $bonus_arme + $deAttaque;
    }

    //Fonction permettant de savoir si le spell ($spell_id) peut etre lancé avec le mana actuel.
    //return le cout du spell si possible,-1 sinon
    public function canThisSpell($mysqlClient,$spell_id) {
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

    //Fonction qui retourne le montant des dégats magiques que pourrait infliger une attaque magique de ce hero.
    public function getMagicDamage($mysqlClient,$spell_id) {
        $deAttaque1 = rand(1,6);
        $deAttaque2 = rand(1,6);
        $id = $this->hero_id;
        $cost = canThisSpell($spell_id); // recuperation du cout de mana,la verification se fera sur le controller

        //requete permettant de mettre a jour le mana du hero apres utilisation.
        $sql = "UPDATE HERO SET HERO_MANA = HERO_MANA - :cost WHERE hero_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':cost', $cost);
        $donnee = [];
        $res = majDonneesPrepareesTabPDO($cur, $donnee);

        $this->hero_mana -= $cost;

        return $deAttaque1 + $deAttaque2 + $cost;
    }

     //fonction qui met a jour les pv du hero apres avoir subit les degats mis en parametre auxquels on soustrait la defense du hero
    public function takeDamage($mysqlClient,$damage)
    {
        $deDefenseur = rand(1,6);
        $bonus_armure = 0; //initialisation du bonus d'armure a 0
        $id = $this->hero_id;
        $idItemType = 2;

        //requete pour recuperer le bonus que confere l'armure equipe par le hero.
        $sql = "SELECT ITEMS_EFFICIENCY FROM ITEMS JOIN TYPEEQUIPMENT USING(ITEMS_ID) JOIN EQUIPMENT USING(ITEMS_ID) WHERE hero_id = :id and TYPEEQUIPMENT_TYPE = :id_type";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        ajouterParamPDO($cur, ':id_type', $idItemType);
        $donnee = [];
        $res2 = LireDonneesPDOPreparee($cur, $donnee);

        if($res2 > 0) {
            $bonus_armure = $donnee[0]["ITEMS_EFFICIENCY"];
        }

        if($this->class_id == 2) {
            $diff = max(0,$damage - ($this->hero_initiative/2 + $bonus_armure + $deDefenseur));
        }
        else {
            $diff = max(0,$damage - ($this->hero_strength/2 + $bonus_armure + $deDefenseur));
        }

        $sql = "UPDATE HERO SET HERO_PV = HERO_PV - :diff WHERE hero_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id,'nombre');
        ajouterParamPDO($cur, ':diff', $diff,'nombre');
        $donnee = [];
        $res1 = $cur->execute();
        $this->hero_pv -= $diff;
    }

    //Fonction retournant un booleen afin de savoir si un item est contenu dans l'inventaire du hero

    public function itemInInventory($mysqlClient,$items_id) {
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

    //Fonction permettant l'utilisation d'une potion de mana ou de soin
    public function consumeAPotion($mysqlClient,$items_id) {
        $efficiency = 0;
        $amount = 0;

        if(itemInInventory($items_id)) {

            //requete afin de recuperer l'éfficacité(le nombre de pv ou de mana que va nous regenerer cette potion)
        $sql = "SELECT ITEMS_EFFICIENCY FROM ITEMS WHERE items_id = :items_id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':items_id', $items_id);
        $donnee = [];
        $res2 = LireDonneesPDOPreparee($cur, $donnee);

        $efficiency = $donnee[0]["ITEMS_EFFICIENCY"];

            $id = $this->hero_id;
            //requete afin de recuperer le nombre de potion dans l'inventaire du hero
            $sql = "SELECT ITEMS_AMOUNT FROM INVENTORY WHERE hero_id = :id AND items_id = :items_id";
            $cur = preparerRequetePDO($mysqlClient, $sql);
            ajouterParamPDO($cur, ':items_id', $items_id);
            ajouterParamPDO($cur, ':id', $id);
            $donnee = [];
            $res2 = LireDonneesPDOPreparee($cur, $donnee);
            
            $amount = $donnee[0]["ITEMS_AMOUNT"];

            $amount -= 1; //utilisation de la potion

            if($amount > 0) { //si apres utilisation de la potion,il en reste alors on enleve 1 potion
            $sql = "UPDATE INVENTORY SET ITEMS_AMOUNT = :amount WHERE hero_id = :id";
            $cur = preparerRequetePDO($mysqlClient, $sql);
            ajouterParamPDO($cur, ':id', $id);
            ajouterParamPDO($cur, ':amount', $amount);
            $donnee = [];
            $res1 = majDonneesPrepareesTabPDO($cur, $donnee);
            }

            else { //sinon on supprime directement l'item de l'inventaire pour ne plus l'afficher.
                $sql = "DELETE FROM INVENTORY WHERE hero_id = :id";
                $cur = preparerRequetePDO($mysqlClient, $sql);
                ajouterParamPDO($cur, ':id', $id);
                $donnee = [];
                $res1 = majDonneesPrepareesTabPDO($cur, $donnee);
            }

            if($items_id == 5) { //determination de quel type de potion il s'agit afin de savoir quel attribut sera regen
                //si item_id == 5 alors c'est un potion de heal
                $sql = "UPDATE HERO SET HERO_PV += :efficiency WHERE hero_id = :id";
                $cur = preparerRequetePDO($mysqlClient, $sql);
                ajouterParamPDO($cur, ':id', $id);
                ajouterParamPDO($cur, ':efficiency', $efficiency);
                $donnee = [];
                $res1 = majDonneesPrepareesTabPDO($cur, $donnee);

                $this->hero_pv+=$efficiency;
            }
            else { //sinon c'est une potion de mana
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
