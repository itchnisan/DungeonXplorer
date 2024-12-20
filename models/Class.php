<?php

// models/Class.php

abstract class Classe
{
    protected $id;
    protected $name;
    protected $description;
    protected $base_pv;
    protected $base_mana;
    protected $strength;
    protected $initiative;
    protected $max_itemes;

    public function __construct($id, $name, $desc, $health, $mana, $initiative, $strength, $max_itemes)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $desc;
        $this->base_pv = $health;
        $this->base_mana = $mana;
        $this->strength = $strength;
        $this->initiative = $initiative;
        $this->max_itemes = $max_itemes;
    }

    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
          // On récupère le nom du setter correspondant à l'attribut
          $method = 'set'.ucfirst($key);
              
          // Si le setter correspondant existe.
          if (method_exists($this, $method)) {
            // On appelle le setter
            $this->$method($value);
          }
        }
      }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDesc()
    {
        return $this->description;
    }

    public function getHealth()
    {
        return $this->base_pv;
    }

    public function getMana()
    {
        return $this->base_mana;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function getInitiative()
    {
        return $this->initiative;
    }

    public function getMax_items()
    {
        return $this->max_itemes;
    }
}
