<?php
//GEstion (et démarrage) des sessions
session_start();

//Affichage des erreurs PHP (à ne pas faire en production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Auto-chargement des classes
spl_autoload_register(function ($sNamespaceClass) {
    $sConvertedClass = str_replace('\\', '/', $sNamespaceClass);
    $sFilepath = $sConvertedClass . '.php';
    include_once($sFilepath);
});

?>