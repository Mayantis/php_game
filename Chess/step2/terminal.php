<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Auto-chargement des classes
spl_autoload_register(function($sNamespaceClass){
    $sConvertedClass = str_replace('\\', '/', $sNamespaceClass);
    $sFilepath = $sConvertedClass . '.php';
    include_once($sFilepath);
});

use \Model\ChessGame;
use \Entity\Player;

echo PHP_EOL . '== Démarage de la partie ==' . PHP_EOL . PHP_EOL;

// 0. Ouvrir une connexion PDO
//print_r($oPdo);

echo '== Leaderboard ==' . PHP_EOL;

foreach(Player::loadAll() as $oPlayer) {
    
    echo sprintf('[%d] %s', $oPlayer->getScore(), $oPlayer->getName()) . PHP_EOL;
}
echo '== /Leaderboard ==' . PHP_EOL ;

// 1. Créer un plateau de jeu
$oGame = new ChessGame();

// 2. Afficher le plateau de jeu
echo $oGame;
// 3. Créer les joueurs
foreach (ChessGame::TEAMS as $sTeam) {
    $sName = readline('Pseudo du Joueur ' . $sTeam . ' :');

    //TODO : Récupérer le joueur en BDD si possible sinon créer le joueur

    $oPlayer = Player::getByName($sName);

    if(!$oPlayer instanceof Player){
        $oPlayer = new Player($sName, $sTeam);
        // Uniquement dans le cas d'un setter "fluent" (=> return $this)
        // $oGame -> addPlayer($oPlayer->setTeam($sTeam));
    }
    // Uniquement dans le cas d'un setter 'fluent' (=> return $this)
    $oGame->addPlayers($oPlayer->setTeam($sTeam));

    //echo $oPlayer;
}
$oGame ->fillBoard();
echo $oGame;

/*
do{
    echo '== Nouveau tour de jeu==' . PHP_EOL;
    
}while($oGame->playRound());
*/

do {
    echo '== Nouveau tour de jeu==' . PHP_EOL;

    list($x, $y) = explode(',', readline('(x,y)?'));
    $oGame -> selectCell($x, $y);

    echo $oGame;

} while (true);

echo '== Fin de la partie ==' . PHP_EOL;