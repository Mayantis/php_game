<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Auto-chargement des classes
spl_autoload_register(function($sNamespaceClass){
    $sConvert = str_replace('\\', '/', $sNamespaceClass);
    $sFilepath = $sConvert . '.php';
    include_once($sFilepath);
});

use \Model\MorpionGame;



echo PHP_EOL . '== Démarage de la partie ==' . PHP_EOL . PHP_EOL;

$oGame = new MorpionGame();

foreach (MorpionGame::PAWNS as $sPawn) {
    $sName = readline('Pseudo du Joueur ' . $sPawn . ' :');
    $oGame -> addPlayers(new \Entity\Player($sName, $sPawn));
}
echo $oGame;

do{
    echo '== Nouveau tour de jeu==' . PHP_EOL;
}while($oGame->playRound());

echo '== Fin de la partie ==' . PHP_EOL;