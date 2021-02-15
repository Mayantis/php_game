<?php
    error_reporting( E_ALL );
    ini_set( 'display_errors', 1 );

    define( 'SIZE_X', 10 );
    define( 'SIZE_Y', 10 );

    define('WARRIOR', 'type1');
    define('WIZARD', 'type2');
    
    include_once './functions.php';

    echo '== Début du programme ==' . PHP_EOL . PHP_EOL; //Constante saut de ligne = \n
    // 1. Créer le plateau de jeu
    $aBoard = [];

    for( $y = 0; $y < SIZE_Y; $y ++ ) {
        $aBoard[ $y ] = [];
        for( $x = 0; $x < SIZE_X; $x ++ ) {
            $aBoard[ $y ][ $x ] = '.';
        }
    }   //print_r($aBoard);
    
    // 2.Initialisation des personnages
    $aWarior = array(
        'name'     => 'Aragorn',
        'health'   => 100,
        'strength' => 50,
        'type'     => WARRIOR,
    );

    $aWizard = array(
        'name'     => 'Gandalf',
        'health'   => 120,
        'strength' => 20,
        'magic'    => 250,
        'type'     => WIZARD,
    );

    $aWizard2 = array(
        'name'     => 'Saruman',
        'health'   => 80,
        'strength' => 30,
        'magic'    => 200,
        'type'     => WIZARD,
    );

    $aWarior2 = array(
        'name'     => 'Legolas',
        'health'   => 300,
        'strength' => 40,
        'type'     => WARRIOR,
    );

    $aCharacters =  array( $aWarior, $aWizard, $aWizard2, $aWarior2,);

    //print_r($aCharacters);
    displayPlayers($aCharacters);
    echo PHP_EOL;

    //3.Positionnemer (aleatoirement) les Personnages
    foreach ( $aCharacters as $aCharacter ) {
        $x = rand( 0, ( SIZE_X - 1 ) );
        $y = rand( 0, ( SIZE_Y - 1 ) );
        if( $aBoard[ $y ][ $x ] !== $aCharacter ) {
            $aBoard[ $y ][ $x ] = $aCharacter;
            echo '[' . $x . '/' . $y . '] : ' . $aCharacter[ 'name' ] . PHP_EOL;
        }
        else {
            $aBoard[ rand(0, ( SIZE_Y - 1 ) ) ][ rand(0, ( SIZE_X - 1 ) ) ] = $aCharacter;
            echo '[' . $x . '/' . $y . ']' . $aCharacter['name'] . PHP_EOL;
        }
    }
    echo PHP_EOL . PHP_EOL;

    //4.Affichage du tableau board en forme de grille
    displayBoard($aBoard);
    echo PHP_EOL;

    displayPlayers($aCharacters);
    echo PHP_EOL . PHP_EOL;     //print_r($aBoard);
    
    echo '== Fin du programme ==' . PHP_EOL;
