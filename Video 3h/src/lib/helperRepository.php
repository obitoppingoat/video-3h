<?php

/**
 * Créer une connexion a la bdd à partir des données de config du fichier de configurer config/database.php
 */

function connectToDatabase(){
    //pour éviter d'ouvrir une connexion à chaque fois que l'on fera appel à une fonction d'un repository, je rends
    //global la variable qui la contient
    global $globalConnexion;
    //si la connexion existe déjà, on n'ouvre pas de nouvelle connexion
    if(isset($globalConnexion)){
        return;
    }
require_once '../config/database.php';

    $host = $configDatabase['host'];
    $port = $configDatabase['port'];
    $dbname = $configDatabase['dbname'];
    $charset = $configDatabase['charset'];
    $user = $configDatabase['user'];
    $pwd = $configDatabase['pwd'];

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

$globalConnexion = new PDO($dsn, $user, $pwd);

}