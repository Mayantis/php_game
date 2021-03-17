<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'functions.php';
include_once 'model/Player.php';

define('SIZE_X', 3);
define('SIZE_Y', 3);

define('NB_PLAYERS', 2);

echo PHP_EOL . '== Démarage de la partie ==' . PHP_EOL . PHP_EOL;
//1.Créer un plateau de jeu 3x3
$aBoard = createBoard();

//2.Afficher le plateau de jeu vide
//displayBoard($aBoard);

//3. Créer un tableau de joueur
$aPlayers = [];
$aSymbol = ['X','O'];
// 3a. Ajouter 2 joueurs

for($i=0; $i<NB_PLAYERS ; $i++){
    $oPlayer = new PLayer;
    $sPlayerName = readline('Pseudo du Joueur ' . ($i+1) . ':');
    $oPlayer -> setName($sPlayerName);
    $oPlayer -> setSymbol($aSymbol[$i]);
    echo PHP_EOL . $oPlayer->getName() . ' jouera : ' . $oPlayer->getSymbol() . PHP_EOL;
    $aPlayers[] = $oPlayer;
}

displayBoard($aBoard);

// 4. Effectuer un "tour de jeu"
$bWin = true;
do{
    
    foreach($aPlayers as $oPlayer){
        echo $oPlayer->getName() . ' à vous de jouer !' . PHP_EOL;

        do{
            // readline permet de récupérer une saisie utilisateur
            $sResponse=readline('>> ');
            //print_r($sResponse . PHP_EOL);

            // TODO : récupérer les coordonées saisies (brainstorming)

            //$aParts=explode(',',$sResponse);
            //$x= $aParts[0];
            //$y= $aParts[1];
            list($x, $y) = explode(',', $sResponse);
            //if ( !empty($aBoard[$y][$x]) || validateCoordonate($x, $y))
            $bReplay= (!validateCoordonate($x, $y) ||  !empty(trim($aBoard[$y][$x])));
            if($bReplay){
                echo 'Les coordonées saisies ne sont pas valide. Veuillez ressaisir des coordonées.' . PHP_EOL;
            }
            
        }while($bReplay);

        echo $x . ',' . $y . PHP_EOL . PHP_EOL;

        $aBoard[$y][$x] = $oPlayer -> getSymbol();

        echo $oPlayer . ' viens de jouer en : [' . $x . ',' . $y . '] !' . PHP_EOL;
        displayBoard($aBoard);

        $bWin = Winner($aBoard);
        if ($bWin){
            break;
        }
    }
    
}while(!$bWin);

echo '== Fin de la partie ==' . PHP_EOL;
