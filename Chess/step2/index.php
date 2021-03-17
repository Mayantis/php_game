<?php

session_start();
//print_r($_SESSION);

error_reporting(E_ALL);
ini_set('display_errors', 1);

//Auto-chargement des classes
spl_autoload_register(function ($sNamespaceClass) {
    $sConvertedClass = str_replace('\\', '/', $sNamespaceClass);
    $sFilepath = $sConvertedClass . '.php';
    include_once($sFilepath);
});

use \Model\ChessGame;
use \Entity\Player;

$oGame = (isset($_SESSION['game'])) ? unserialize($_SESSION['game']) : null;
//$oGame = $_SESSION

if (isset($_GET['new'])) {
    // 1. Créer un plateau de jeu
    $oGame = new ChessGame();
    foreach (ChessGame::TEAMS as $sTeam) {
        $oGame->addPlayers(new \Entity\Player($sTeam, $sTeam));
    }
    $oGame->fillBoard();
    $_SESSION['game'] = serialize($oGame);
    header('Location: index.php');
}

$aGameInfo = [];

if ($oGame) {
    if (isset($_GET['x']) && isset($_GET['y'])) {
        // 2. Action sur le plateau de jeu
        $aGameInfo = $oGame->selectCell($_GET['x'], $_GET['y']);
    }
    $_SESSION['game'] = serialize($oGame);

    if (isset($_GET['x']) && isset($_GET['y'])) {
        include('templates/board.php');
        exit();
    }
}
//print_r($oGame->getABoard());
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link href="css/style.css" rel="stylesheet">
    <title>Hello, chess!</title>
</head>

<body class="text-center">
    <h1>Hello, chess!</h1>

    <a href="?new" class="btn btn-primary my-3">Nouvelle partie</a>

    <div class="container align-content-center">
        <?php if ($oGame) : ?>
            <div id="board">
                <?php
                
                include('templates/board.php');
                ?>
            </div>
        <?php endif ?>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        //console.log($(document));
        //console.log($('body'));
        //console.log($('div'));


        // eq. addEventListener
        //$('.cell').on('click', function() {
        $('#board').on('click','.cell' ,function() {
            //console.log($(this));
            let x = $(this).data('x');
            let y = $(this).data('y');
            //console.log('Click');
            console.log(x + ',' + y);

            //Communiquer avec le jeu
            //window.location = '?x=' + x + '&y=' + y;

            //AJAX - Requête GET:
            $.get('index.php?x=' + x + '&y=' + y, function(data, status) {
                //console.log(status);
                //console.log(data);

                /*let board = document.getElementById('board');
                board.innerHTML = data;*/
                $('#board').html(data);

            });
        });
    </script>
</body>

</html>