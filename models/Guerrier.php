<?php

// models/Guerrier.php

class Guerrier extends Classe
{
    public function __construct()
    {
        parent::__construct(1,'Guerrier', 'DEMACIA', 100, 0, 5, 15,15);
    }

    /*public function attack()
    {
        return "{$this->name} vous charge avec sa massue.";
    }*/
}
