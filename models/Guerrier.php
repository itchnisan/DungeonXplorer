<?php

// models/Guerrier.php


class Guerrier extends Classe
{
    public function __construct($mysqlClient)
    {
        parent::__construct();

        $id = 1;

        $sql = "SELECT * FROM CLASS WHERE class_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);

        parent::hydrate($donnee[0]);
    }
}
