<?php
include_once('_bootstrap.php');

use \Model\RpgGame;
use \Entity\Player;

$oGame = (isset($_SESSION['game'])) ? unserialize($_SESSION['game']) : null;
$oPlayer = (isset($_SESSION['player'])) ? unserialize($_SESSION['player']) : null;

if (isset($_GET['new'])) {

    $oPlayer = (new Player('Mayantis'));
    $oCharacter = (new \Model\Characters\Wizard('Gandalf'));

    // Liaisons Player-Character / Character-Player
    $oPlayer->setCharacter($oCharacter->setPlayer($oPlayer));

    // 1. Créer un plateau de jeu
    $oGame = new RpgGame();
    $oGame->addPlayer($oPlayer);

    $oGame->fillBoard();

    // On enregistre le jeu en session
    $_SESSION['game'] = serialize($oGame);
    $_SESSION['player'] = serialize($oPlayer);

}

if (!$oGame || !$oPlayer) {
    exit;
}

$aGameInfo = [];
// 2. Action sur le plateau de jeu:
// Action spéciale : clic sur une case
if (isset($_GET['x']) && isset($_GET['y'])) {
    $aGameInfo = $oGame->selectCell($oPlayer, $_GET['x'], $_GET['y']);
}
// Action spéciale : refresh automatique
elseif (isset($_GET['refresh'])) {
    $oGame->lifeTime();
}
// On enregistre le jeu 'modifié' en session
$_SESSION['game'] = serialize($oGame);
$_SESSION['player'] = serialize($oPlayer);

include('templates/board.php');
exit();