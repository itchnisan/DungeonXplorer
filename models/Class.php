<?php

// models/Class.php

abstract class Classe
{
    protected $class_id;
    protected $class_name;
    protected $class_description;
    protected $class_base_pv;
    protected $class_base_mana;
    protected $class_strength;
    protected $class_initiative;
    protected $class_max_itemes;

    public function __construct()
    {
        $this->class_id = null;
        $this->class_name = null;
        $this->class_description = null;
        $this->class_base_pv = null;
        $this->class_base_mana = null;
        $this->class_strength = null;
        $this->class_initiative = null;
        $this->class_max_itemes = null;
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

    // Getter et Setter pour class_id
    public function getClassId()
    {
        return $this->class_id;
    }

    public function setClassId($class_id): self
    {
        $this->class_id = $class_id;
        return $this;
    }

    // Getter et Setter pour class_name
    public function getClassName()
    {
        return $this->class_name;
    }

    public function setClassName($class_name): self
    {
        $this->class_name = $class_name;
        return $this;
    }

    // Getter et Setter pour class_description
    public function getClassDescription()
    {
        return $this->class_description;
    }

    public function setClassDescription($class_description): self
    {
        $this->class_description = $class_description;
        return $this;
    }

    // Getter et Setter pour class_base_pv
    public function getClassBasePv()
    {
        return $this->class_base_pv;
    }

    public function setClassBasePv($class_base_pv): self
    {
        $this->class_base_pv = $class_base_pv;
        return $this;
    }

    // Getter et Setter pour class_base_mana
    public function getClassBaseMana()
    {
        return $this->class_base_mana;
    }

    public function setClassBaseMana($class_base_mana): self
    {
        $this->class_base_mana = $class_base_mana;
        return $this;
    }

    // Getter et Setter pour class_strength
    public function getClassStrength()
    {
        return $this->class_strength;
    }

    public function setClassStrength($class_strength): self
    {
        $this->class_strength = $class_strength;
        return $this;
    }

    // Getter et Setter pour class_initiative
    public function getClassInitiative()
    {
        return $this->class_initiative;
    }

    public function setClassInitiative($class_initiative): self
    {
        $this->class_initiative = $class_initiative;
        return $this;
    }

    // Getter et Setter pour class_max_itemes
    public function getClassMaxItemes()
    {
        return $this->class_max_itemes;
    }

    public function setClassMaxItemes($class_max_itemes): self
    {
        $this->class_max_itemes = $class_max_itemes;
        return $this;
    }

}
