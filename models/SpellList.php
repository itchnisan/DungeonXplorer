<?php

// models/SpellList.php

class SpellList
{
    protected $heroId;
    protected $spellId;

    public function __construct($heroId, $spellId)
    {
        $this->heroId = $heroId;
        $this->spellId = $spellId;
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
     * Get the value of spellId
     */
    public function getSpellId()
    {
        return $this->spellId;
    }

    /**
     * Set the value of spellId
     */
    public function setSpellId($spellId): self
    {
        $this->spellId = $spellId;
        return $this;
    }
}
