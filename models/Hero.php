<?php

// models/Hero.php

class Hero
{
    protected $id;
    protected $userId;
    protected $name;
    protected $class_id;
    protected $image;
    protected $biography;
    protected $pv;
    protected $mana;
    protected $strength;
    protected $initiative;
    protected $bourse;
    protected $xp;
    protected $currentLevel;

    public function __construct($userId, $name,$class_id, $image, $biography, $pv, $mana, $strength, $initiative, $bourse, $xp, $currentLevel)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->class_id = $class_id;
        $this->image = $image;
        $this->biography = $biography;
        $this->pv = $pv;
        $this->mana = $mana;
        $this->strength = $strength;
        $this->initiative = $initiative;
        $this->bourse = $bourse;
        $this->xp = $xp;
        $this->currentLevel = $currentLevel;
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

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
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     */
    public function setUserId($userId): self
    {
        $this->userId = $userId;

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
     * Get the value of bourse
     */
    public function getBourse()
    {
        return $this->bourse;
    }

    /**
     * Set the value of bourse
     */
    public function setBourse($bourse): self
    {
        $this->bourse = $bourse;

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
     * Get the value of currentLevel
     */
    public function getCurrentLevel()
    {
        return $this->currentLevel;
    }

    /**
     * Set the value of currentLevel
     */
    public function setCurrentLevel($currentLevel): self
    {
        $this->currentLevel = $currentLevel;

        return $this;
    }

    /**
     * Get the value of class_id
     */
    public function getClassId()
    {
        return $this->class_id;
    }

    /**
     * Set the value of class_id
     */
    public function setClassId($class_id): self
    {
        $this->class_id = $class_id;

        return $this;
    }
}
