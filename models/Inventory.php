<?php

// models/Inventory.php

class Inventory
{
    protected $inventory_id;
    protected $hero_id;
    protected $items_id;
    protected $items_amount;

    public function __construct()
    {
        $this->inventory_id = null;
        $this->hero_id = null;
        $this->items_id = null;
        $this->items_amount = null;
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

    public function getInventoryId()
    {
        return $this->inventory_id;
    }

    public function setInventoryId($inventory_id): self
    {
        $this->inventory_id = $inventory_id;
        return $this;
    }

    public function getHeroId()
    {
        return $this->hero_id;
    }

    public function setHeroId($hero_id): self
    {
        $this->hero_id = $hero_id;
        return $this;
    }

    public function getItemsId()
    {
        return $this->items_id;
    }

    public function setItemsId($items_id): self
    {
        $this->items_id = $items_id;
        return $this;
    }

    public function getItemsAmount()
    {
        return $this->items_amount;
    }

    public function setItemsAmount($items_amount): self
    {
        $this->items_amount = $items_amount;
        return $this;
    }
}
