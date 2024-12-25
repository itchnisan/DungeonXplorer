<?php

include_once "pdo_agile.php";
$mysqlClient = OuvrirConnexionPDO('mysql:host=localhost;dbname=dx_10;charset=utf8', 'root' , '');

return $mysqlClient;
?>