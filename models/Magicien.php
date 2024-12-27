<?php


class Magicien extends Classe
{
    public function __construct($mysqlClient)
    {
        parent::__construct();

        $id = 3;

        $sql = "SELECT * FROM CLASS WHERE class_id = :id";
        $cur = preparerRequetePDO($mysqlClient, $sql);
        ajouterParamPDO($cur, ':id', $id);
        $donnee = [];
        $res = LireDonneesPDOPreparee($cur, $donnee);
        echo $res;
        var_dump($donnee);
        parent::hydrate($donnee[0]);
    }
}