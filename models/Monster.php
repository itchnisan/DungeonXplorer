<?php

// models/Monster.php

abstract class Monster
{
    protected $name;
    protected $health;
    protected $mana;
    protected $experienceValue;
    protected $treasure;

    public function __construct()
    {
        $this->name = null;
        $this->health = null;
        $this->mana = null;
        $this->experienceValue = null;
        $this->treasure = null;
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    abstract public function attack();

    public function getName()
    {
        return $this->name;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getMana()
    {
        return $this->mana;
    }

    public function takeDamage($damage)
    {
        $this->health -= $damage;
    }

    public function isAlive()
    {
        return $this->health > 0;
    }

    public function getExperienceValue()
    {
        return $this->experienceValue;
    }

    public function getTreasure()
    {
        return $this->treasure;
    }
}
