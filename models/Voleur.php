<?php

// models/Voleur.php


class Voleur extends Classe
{
    public function __construct($mysqlClient)
    {
        parent::__construct();

        $id = 2;

        $sql = "SELECT * FROM CLASS WHERE class_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);

        parent::hydrate($donnee[0]);
    }
}