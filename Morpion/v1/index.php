<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'functions.php';

define('SIZE_X', 3);
define('SIZE_Y', 3);

echo PHP_EOL . '== Démarage de la partie ==' . PHP_EOL . PHP_EOL;
//1.Créer un plateau de jeu 3x3
$aBoard = createBoard();

//2.Afficher le plateau de jeu vide
displayBoard($aBoard);

//3. Créer un tableau de joueur
$players = [];

// 3a. Ajouter 2 joueurs
$players[] = 'Player 1';
$players[] = 'Player 2';

// 4. Effectuer un "tour de jeu"
foreach($players as $player){
    echo $player . ' à vous de jouer !' . PHP_EOL;
    $sResponse=readline('>> ');
    print_r($sResponse . PHP_EOL);
}

echo '== Fin de la partie ==' . PHP_EOL;