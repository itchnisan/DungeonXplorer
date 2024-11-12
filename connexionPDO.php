<?php

try 
{
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=dx10_bd;charset=utf8', 'dx10' , 'shiaj0neesheeQui'
    );
    echo('connexion réussie');
}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}




?>