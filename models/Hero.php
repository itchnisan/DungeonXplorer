<?php

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
