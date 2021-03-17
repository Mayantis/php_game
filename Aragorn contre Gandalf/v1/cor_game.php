<?php
    /*
     * Game - v1 - Attention $x et $y sont inversés
     */

    // Affichage de toutes les erreurs (et warnings)
    // > A ne pas faire en environnement de production
    error_reporting(E_ALL);
    ini_set('display_errors', 0);

    echo '== Début du programme =='.PHP_EOL;


    // 1. Créer le plateau de jeu (tableau "5x5")
    // > Tableau à 2 dimensions (tableau de tableau) 
    // > $board[0][0] > $board[x][y] = '.';

    $board = [];
    // -- Initialisation des lignes
    for ($x = 0 ; $x < 5 ; $x++) {
        $board[ $x ] = [];

        // -- Initialisation des colonnes
        for ($y = 0 ; $y < 5 ; $y++) {
            $board[ $x ][ $y ] = '.';
        }
    }
    print_r($board);


    // 2. Créer les personnages Aragorn et Gandalf
    $aragorn = [
        'name' => 'Aragorn',
        'health' => 100,
        'strength' => 50,
    ];
    $gandalf = [
        'name' => 'Gandalf',
        'health' => 80,
        'strength' => 20,
        'magic' => 200,
    ];

    // -- Variable permettant de simplifier la gestion des "joueurs"
    $characters = [$aragorn, $gandalf];

    // Aragorn : [H:100] [S:50]
    echo $aragorn['name'] . ' : [H:'.$aragorn['health'].'] [S:'.$aragorn['strength'].']'.PHP_EOL;
    // Gandalf : [H:80] [S:20] [M:200]
    echo $gandalf['name'] . ' : [H:'.$gandalf['health'].'] [S:'.$gandalf['strength'].'] [M:'.$gandalf['magic'].']'.PHP_EOL;

    // -- Affichage dynamique des joueurs
    foreach ($characters as $character) {
        // -- Solution 1 (non optimisée)
        /*if (array_key_exists('magic', $character)) {
            echo $character['name'] . ' : [H:'.$character['health'].'] [S:'.$character['strength'].'] [M:'.$character['magic'].']'.PHP_EOL;  
        } else {
            echo $character['name'] . ' : [H:'.$character['health'].'] [S:'.$character['strength'].']'.PHP_EOL;
        }*/

        // -- Solution 2 (partiellement optimisée)
        /*echo $character['name'] . ' : [H:'.$character['health'].'] [S:'.$character['strength'].']';
        if (isset('magic', $character)) {
             echo ' [M:'.$character['magic'].']'.PHP_EOL;  
        } else {
            echo PHP_EOL;
        }*/

        // -- Solution 3 (optimisée)
        echo $character['name'] . ' : [H:'.$character['health'].'] [S:'.$character['strength'].']';
        if (!empty($character['magic'])) {
             echo ' [M:'.$character['magic'].']';  
        }
        echo PHP_EOL;
    }

    
    // 3. Positionner (aléatoirement) tous nos joueurs dans le plateau
    // ex: $board[x][y] = $gandalf;
    foreach ($characters as $character) {
        $board[ rand(0, 4) ][ rand(0, 4) ] = $character;
    }


    // 4. Afficher le plateau de jeu proprement 
    // [.] [.] [.]
    // [.] [.] [.]
    // [.] [.] [.]
    
    // -- Parcours des lignes
    for ($x = 0 ; $x < 5 ; $x++) {
        // -- Parcours des colonnes
        for ($y = 0 ; $y < 5 ; $y++) {
            if (is_array( $board[ $x ][ $y ] )) {
                $aChar = $board[ $x ][ $y ];
                echo '['. substr($aChar['name'], 0, 1) .'] ';
                // echo '['. $board[ $x ][ $y ][ 'name' ][0] .'] ';
            }
            else {
                echo '['. $x .','.$y .'] ';
            }
        }
        echo PHP_EOL;
    }
    echo PHP_EOL;

    echo '== Fin du programme =='."\n";
?>