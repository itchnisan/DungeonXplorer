<?php

// models/Items.php

class Items
{
    protected $items_id;
    protected $items_name;
    protected $items_description;
    protected $items_size;
    protected $items_efficiency;

    public function __construct()
    {
        $this->items_id = null;
        $this->items_name = null;
        $this->items_description = null;
        $this->items_size = null;
        $this->items_efficiency = null;
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

    public function getItemsId()
    {
        return $this->items_id;
    }

    public function setItemsId($items_id): self
    {
        $this->items_id = $items_id;
        return $this;
    }

    public function getItemsName()
    {
        return $this->items_name;
    }

    public function setItemsName($items_name): self
    {
        $this->items_name = $items_name;
        return $this;
    }

    public function getItemsDescription()
    {
        return $this->items_description;
    }

    public function setItemsDescription($items_description): self
    {
        $this->items_description = $items_description;
        return $this;
    }

    public function getItemsSize()
    {
        return $this->items_size;
    }

    public function setItemsSize($items_size): self
    {
        $this->items_size = $items_size;
        return $this;
    }

    public function getItemsEfficiency()
    {
        return $this->items_efficiency;
    }

    public function setItemsEfficiency($items_efficiency): self
    {
        $this->items_efficiency = $items_efficiency;
        return $this;
    }
}
