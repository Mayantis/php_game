<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'functions.php';

const SIZE_X = 3;
const SIZE_Y = 3;

echo '== Début du programme =='.PHP_EOL;

// 1. Créer un plateau de jeu 3x3
$aBoard = createBoard();

// 2. Afficher le plateau de jeu vide
displayBoard($aBoard);

// 3. Créer un tableau de joueurs et ajouter 2 joueurs
$aPlayers = [];
$aPlayers[] = 'O';
$aPlayers[] = 'X';

// 4. Effectuer un "tour de jeu"
do {
  foreach ($aPlayers as $sPlayer) {
    echo $sPlayer.' à vous de jouer !' . PHP_EOL;

    do {
      // Obtenir les coordonnées saisies désirées par le joueur
      // readline permet de récupérer une saisie utilisateur
      // explode : permet de scinder une chaîne de caractère en un tableau (plusieurs morceaux)
      // [0] > Premier résultat     [1] > Second résultat
      $sResponse = readline('>> Quelle case ? ');  
      $aParts = explode(',',  $sResponse);
      $x = $aParts[0];
      $y = $aParts[1];
      
      // équivalent à     list($x, $y) = explode(',',  $sResponse);
      // équivalent à     [$x, $y] = explode(',',  $sResponse);

      // On teste si la case est vide ET si les coordonnées sont valides
      // trim = supprime les espaces présents
      $bReplay = !isValidXY($y, $y) || !empty(trim($aBoard[$y][$x]));
      if ($bReplay) {
        echo 'Case déjà prise OU coordonnées invalides'.PHP_EOL;
      }
      // Condition de "reboucle" : pas valide ou pas vide
    } while ($bReplay);

    // On assigne le joueur/pion dans la case
    $aBoard[$y][$x] = $sPlayer;

    // Affichage plateau après que le joueur est joué
    displayBoard($aBoard);

    // Il faut appeler isWin après le tour de chaque joueur pour arrêter la partie directement en cas de victoire
    $bWin = isWin($aBoard);
    if ($bWin) {
      break;
    }
  }
} while (!$bWin);

echo '== Fin du programme =='.PHP_EOL;
