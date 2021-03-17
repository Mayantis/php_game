<?php
    /*
     * Game - v2 - Correction $x et $y
     */

     // Affichage de toutes les erreurs (et warnings)
     // > A ne pas faire en environnement de production
     error_reporting(E_ALL);
     ini_set('display_errors', 0);

    include_once 'functions.php';
    //include 'functions.php';

    // Solution 1 (simple)
    //define('TYPE_WARRIOR', 'Warrior');
    //define('TYPE_WARRIOR', 'Wizard');

    // Solution 2 (avancée)
    define('TYPE_WARRIOR', [
      'name' => 'Warrior',
      'min_health' => 100,
      'max_health' => 150,
      'min_strength' => 100,
      'max_strength' => 200,
    ]);
    define('TYPE_WIZARD', [
      'name' => 'Wizard',
      'min_health' => 50,
      'max_health' => 80,
      'min_strength' => 50,
      'max_strength' => 80,
      'min_magic' => 150,
      'max_magic' => 200,
     ]);
    /*
      define('TYPE_WARRIOR', 1);
      define('TYPE_WIZARD', 2);
    */

    define('SIZE_X', 10);
    define('SIZE_Y', 10);
    //const SIZE_X = 5;
    //const SIZE_Y = 5;

    echo '== Début du programme =='.PHP_EOL;


    // 1. Créer le plateau de jeu (tableau "5x5")
    // > Tableau à 2 dimensions (tableau de tableau)
    // > $board[0][0] > $board[y][x] = '.';

    $board = [];
    // -- Initialisation des lignes
    for ($y = 0 ; $y < SIZE_Y ; $y++) {
        $board[ $y ] = [];

        // -- Initialisation des colonnes
        for ($x = 0 ; $x < SIZE_X ; $x++) {
            $board[ $y ][ $x ] = '.';
        }
    }
    //print_r($board);


    // 2. Créer les personnages Aragorn et Gandalf
    $aragorn = [
        'type' => TYPE_WARRIOR,
        'name' => 'Aragorn',
        'position' => ['x' => null, 'y' => null],
        //'health' => null,   // Pas obligatoire en PHP (!= JAVA)
        //'strength' => null,   // Pas obligatoire en PHP (!= JAVA)
    ];
    // Passage par référence (défaut), du coup $aragorn en paramètre n'est pas modifié et il faut récupérer la valeur retour pour avoir le tableau $aragorn rempli
    //$aragorn = buildCaracteristicsByCopy($aragorn);

    $gandalf = [
        'type' => TYPE_WIZARD,
        'name' => 'Gandalf',
        'position' => ['x' => null, 'y' => null],
        //'health' => null,   // Pas obligatoire en PHP (!= JAVA)
        //'strength' => null,   // Pas obligatoire en PHP (!= JAVA)
    ];
    // Passage par référence (grâce au &), du coup $gandalf est bien modifié
    //buildCaracteristicsByRef($gandalf);

    // -- Variable permettant de simplifier la gestion des "joueurs"
    $characters = [$aragorn, $gandalf];

    // -- Remplissage des caractéristiques d'un seul coup
    // > Il faut là aussi utiliser la variable par "référence" (&) et non par copie (défaut)
    foreach ($characters as &$character) {
      buildCaracteristicsByRef($character);
    }
    unset($character);  // On force la réinitialisation de la variable

    // Aragorn : [H:100] [S:50]
    //echo $aragorn['name'] . ' : [H:'.$aragorn['health'].'] [S:'.$aragorn['strength'].']'.PHP_EOL;
    // Gandalf : [H:80] [S:20] [M:200]
    //echo $gandalf['name'] . ' : [H:'.$gandalf['health'].'] [S:'.$gandalf['strength'].'] [M:'.$gandalf['magic'].']'.PHP_EOL;

    displayPlayers ($characters);


    // 3. Positionner (aléatoirement) tous nos joueurs dans le plateau
    // ex: $board[y][x] = $gandalf;
    foreach ($characters as $character) {
        $board[ $character['position']['y'] ][ $character['position']['x'] ] = $character;
    }
    echo PHP_EOL;


    // 4. Afficher le plateau de jeu proprement
    displayBoard($board);


    // 5. Ré-affichage dynamique des joueurs
    displayPlayers($characters);

    echo '== Fin du programme =='."\n";

// Fermeture PHP non obligatoire et non optimale
?>
