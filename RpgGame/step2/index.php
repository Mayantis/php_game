<?php
include_once('_bootstrap.php');
$oGame = (isset($_SESSION['game'])) ? unserialize($_SESSION['game']) : null;
$oPlayer = (isset($_SESSION['player'])) ? unserialize($_SESSION['player']) : null;
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

    <div class="btn btn-primary my-3" id="new-game">Nouvelle partie</div>

    <div class="container align-content-center">
        <div id="board">
            <?php
            if ($oGame) {
                include('templates/board.php');
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="./js/board.js"></script>
</body>

</html>