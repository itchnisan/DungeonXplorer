<?php

// models/Hero.php

abstract class Hero
{
    protected $id;
    protected $name;
    protected $classId;
    protected $image;
    protected $biography;
    protected $pv;
    protected $mana;
    protected $strength;
    protected $initiative;
    protected $armor;
    protected $primary_weapon;
    protected $secondary_weapon;
    protected $shield;
    protected $spell_list;
    protected $xp;
    protected $current_level;

    public function __construct($name,$classID, $image, $biography, $pv, $mana, $strength, $initiative,$armor, $primary_weapon, $secondary_weapon, $shield, $spell_list, $xp, $current_level)
    {
        $this->name = $name;
        $this->classId = $classID;
        $this->image = $image;
        $this->biography = $biography;
        $this->pv = $pv;
        $this->mana = $mana;
        $this->strength = $strength;
        $this->initiative = $initiative;
        $this->armor = $armor;
        $this->primary_weapon = $primary_weapon;
        $this->secondary_weapon = $secondary_weapon;
        $this->shield = $shield;
        $this->spell_list = $spell_list;
        $this->xp = $xp;
        $this->current_level = $current_level;
    }

    //abstract public function attack();

    

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of biography
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set the value of biography
     */
    public function setBiography($biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get the value of pv
     */
    public function getPv()
    {
        return $this->pv;
    }

    /**
     * Set the value of pv
     */
    public function setPv($pv): self
    {
        $this->pv = $pv;

        return $this;
    }

    /**
     * Get the value of mana
     */
    public function getMana()
    {
        return $this->mana;
    }

    /**
     * Set the value of mana
     */
    public function setMana($mana): self
    {
        $this->mana = $mana;

        return $this;
    }

    /**
     * Get the value of strength
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Set the value of strength
     */
    public function setStrength($strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get the value of initiative
     */
    public function getInitiative()
    {
        return $this->initiative;
    }

    /**
     * Set the value of initiative
     */
    public function setInitiative($initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    /**
     * Get the value of armor
     */
    public function getArmor()
    {
        return $this->armor;
    }

    /**
     * Set the value of armor
     */
    public function setArmor($armor): self
    {
        $this->armor = $armor;

        return $this;
    }

    /**
     * Get the value of primary_weapon
     */
    public function getPrimaryWeapon()
    {
        return $this->primary_weapon;
    }

    /**
     * Set the value of primary_weapon
     */
    public function setPrimaryWeapon($primary_weapon): self
    {
        $this->primary_weapon = $primary_weapon;

        return $this;
    }

    /**
     * Get the value of secondary_weapon
     */
    public function getSecondaryWeapon()
    {
        return $this->secondary_weapon;
    }

    /**
     * Set the value of secondary_weapon
     */
    public function setSecondaryWeapon($secondary_weapon): self
    {
        $this->secondary_weapon = $secondary_weapon;

        return $this;
    }

    /**
     * Get the value of shield
     */
    public function getShield()
    {
        return $this->shield;
    }

    /**
     * Set the value of shield
     */
    public function setShield($shield): self
    {
        $this->shield = $shield;

        return $this;
    }

    /**
     * Get the value of spell_list
     */
    public function getSpellList()
    {
        return $this->spell_list;
    }

    /**
     * Set the value of spell_list
     */
    public function setSpellList($spell_list): self
    {
        $this->spell_list = $spell_list;

        return $this;
    }

    /**
     * Get the value of xp
     */
    public function getXp()
    {
        return $this->xp;
    }

    /**
     * Set the value of xp
     */
    public function setXp($xp): self
    {
        $this->xp = $xp;

        return $this;
    }

    /**
     * Get the value of current_level
     */
    public function getCurrentLevel()
    {
        return $this->current_level;
    }

    /**
     * Set the value of current_level
     */
    public function setCurrentLevel($current_level): self
    {
        $this->current_level = $current_level;

        return $this;
    }

    /**
     * Get the value of classId
     */
    public function getClassId()
    {
        return $this->classId;
    }

    /**
     * Set the value of classId
     */
    public function setClassId($classId): self
    {
        $this->classId = $classId;

        return $this;
    }
}
