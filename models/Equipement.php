<?php

// models/Equipment.php

class Equipment
{
    protected $equipmentId;
    protected $heroId;
    protected $itemId;
    protected $itemsType;

    public function __construct($heroId, $itemId, $itemsType)
    {
        $this->heroId = $heroId;
        $this->itemId = $itemId;
        $this->itemsType = $itemsType;
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Get the value of equipmentId
     */
    public function getEquipmentId()
    {
        return $this->equipmentId;
    }

    /**
     * Set the value of equipmentId
     */
    public function setEquipmentId($equipmentId): self
    {
        $this->equipmentId = $equipmentId;
        return $this;
    }

    /**
     * Get the value of heroId
     */
    public function getHeroId()
    {
        return $this->heroId;
    }

    /**
     * Set the value of heroId
     */
    public function setHeroId($heroId): self
    {
        $this->heroId = $heroId;
        return $this;
    }

    /**
     * Get the value of itemId
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set the value of itemId
     */
    public function setItemId($itemId): self
    {
        $this->itemId = $itemId;
        return $this;
    }

    /**
     * Get the value of itemsType
     */
    public function getItemsType()
    {
        return $this->itemsType;
    }

    /**
     * Set the value of itemsType
     */
    public function setItemsType($itemsType): self
    {
        $this->itemsType = $itemsType;
        return $this;
    }
}
