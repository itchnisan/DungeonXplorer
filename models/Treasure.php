<?php

class Treasure
{
    protected $chpter_treasure_id;
    protected $chapter_id;
    protected $item_id;

    public function __construct()
    {
        $this->chpter_treasure_id = null;
        $this->chapter_id = null;
        $this->item_id = null;
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

    // Getters and Setters
    public function getTreasureId()
    {
        return $this->chpter_treasure_id;
    }

    public function setTreasureId($chpter_treasure_id): self
    {
        $this->chpter_treasure_id = $chpter_treasure_id;
        return $this;
    }

    public function getChapterId()
    {
        return $this->chapter_id;
    }

    public function setChapterId($chapter_id): self
    {
        $this->chapter_id = $chapter_id;
        return $this;
    }

    public function getItemId()
    {
        return $this->item_id;
    }

    public function setItemId($item_id): self
    {
        $this->item_id = $item_id;
        return $this;
    }
}