<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

//Auto-chargement des classes
spl_autoload_register(function ($sNamespaceClass) {
    $sConvertedClass = str_replace('\\', '/', $sNamespaceClass);
    $sFilepath = $sConvertedClass . '.php';
    include_once($sFilepath);
});

use \Model\RpgGame;
use \Entity\Player;

$oGame = (isset($_SESSION['game'])) ? unserialize($_SESSION['game']) : null;
$oPlayer = (isset($_SESSION['player'])) ? unserialize($_SESSION['player']) : null;

if (isset($_GET['new'])) {

    $oPlayer = (new Player('Mayantis'));
    $oCharacter = (new \Model\Characters\Warrior('Aragorn'));

    // Liaisons Player-Character / Character-Player
    $oPlayer->setCharacter($oCharacter->setPlayer($oPlayer));

    // 1. Créer un plateau de jeu
    $oGame = new RpgGame();
    $oGame->addPlayer($oPlayer);

    $oGame->fillBoard();

    // On enregistre le jeu en session
    $_SESSION['game'] = serialize($oGame);
    $_SESSION['player'] = serialize($oPlayer);
    header('Location: index.php');
}

$aGameInfo = [];
$aMonsters = [];

if ($oGame) {
    if (isset($_GET['x']) && isset($_GET['y'])) {
        // 2. Action sur le plateau de jeu
        $aGameInfo = $oGame->selectCell($oPlayer, $_GET['x'], $_GET['y']);
    }
    $_SESSION['game'] = serialize($oGame);
    $_SESSION['player'] = serialize($oPlayer);

    if (isset($_GET['x']) && isset($_GET['y'])) {
        include('templates/board.php');
        exit();
    }
}

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
    <title>RpgGame</title>
</head>

<body class="text-center">
    <h1>RpgGame</h1>

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
        function onKeyPress(event) {

            //récupère le joueur selectionné
            let $playerCell = $('.player').parent();

            //Récupère la position de la case du joueur
            let x = $playerCell.data('x');
            let y = $playerCell.data('y');

            switch (event.keyCode) {
                case 37: // gauche
                    x--;
                    break;
                case 38: // haut
                    y--;
                    break;
                case 39: // droite
                    x++;
                    break;
                case 40: // bas
                    y++;
                    break;
                default:
                    break;
            }
            
            if([37,38,39,40].includes(event.keyCode)){
                let $cell = $('.cell[data-x="' + x + '"].cell[data-y="' + y + '"]');
                if($cell){
                    $cell.click();
                }
            }
        }

        document.addEventListener('keyup', onKeyPress);

        document.addEventListener('keydown', function() {
            event.preventDefault;
        });

        $('#board').on('click', '.cell', function() {

            let x = $(this).data('x');
            let y = $(this).data('y');

            console.log(x + ',' + y);
            //Communiquer avec le jeu

            //AJAX - Requête GET:
            $.get('index.php?x=' + x + '&y=' + y, function(data, status) {

                $('#board').html(data);

            });
        });
    </script>
</body>

</html>