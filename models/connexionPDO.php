<?php

include_once "pdo_agile.php";
$mysqlClient = OuvrirConnexionPDO('mysql:host=localhost;dbname=dx10_bd;charset=utf8', 'root' , '');

return $mysqlClient;
?>