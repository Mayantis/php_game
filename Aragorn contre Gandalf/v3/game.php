<?php
    error_reporting( E_ALL );
    ini_set( 'display_errors', 1 );

    define( 'SIZE_X', 10 );
    define( 'SIZE_Y', 10 );

    define('TYPE_WARRIOR', [
        'name' => 'Warrior',
        'min_health' => 100,
        'min_strength' => 30,
        'max_health' => 350,
        'max_strength' => 250,
        ]);

    define('TYPE_WIZARD', [
        'name' => 'Wizard',
        'min_health' => 80,
        'min_strength' => 5,
        'min_magic' => 30,
        'max_health' => 300,
        'max_strength' => 40,
        'max_magic' => 250 
        ]);
    
    include_once './functions_v2.php';

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
    'type'     => TYPE_WARRIOR,
    'position' => array(
        'x' => null,
        'y' => null
    )
);
//$aWarior['health'] = rand($aWarior['type']['min_health'], $aWarior['type']['max_health']);
//$aWarior['strength'] = rand($aWarior['type']['min_strength'], $aWarior['type']['max_strength']);

$aWizard = array(
    'name'     => 'Gandalf',
    'type'     => TYPE_WIZARD,
    'position' => array(
        'x' => null,
        'y' => null
        )
    );
//$aWizard['health']   = rand($aWizard['type']['min_health'], $aWizard['type']['max_health']);
//$aWizard['strength'] = rand($aWizard['type']['min_strength'], $aWizard['type']['max_strength']);
//$aWizard['magic']    = rand($aWizard['type']['min_magic'], $aWizard['type']['max_magic']);


$aWizard2 = array(
    'name'     => 'Saruman',
    'type'     => TYPE_WIZARD,
    'position' => array(
        'x' => null,
        'y' => null
        )
    );
//$aWizard2['health']   = rand($aWizard2['type']['min_health'], $aWizard2['type']['max_health']);
//$aWizard2['strength'] = rand($aWizard2['type']['min_strength'], $aWizard2['type']['max_strength']);
//$aWizard2['magic']   = rand($aWizard2['type']['min_magic'], $aWizard2['type']['max_magic']);

$aWarior2 = array(
    'name'     => 'Legolas',
    'type'     => TYPE_WARRIOR,
    'position' => array(
        'x' => null,
        'y' => null
        )
    );
//$aWarior2['health']   = rand($aWarior2['type']['min_health'], $aWarior2['type']['max_health']);
//$aWarior2['strength'] = rand($aWarior2['type']['min_strength'], $aWarior2['type']['max_strength']);

$aCharacters =  array( $aWarior, $aWizard, $aWizard2, $aWarior2,);



foreach ($aCharacters as &$aCharacter) { // & avant la variable permet de garder les données attribuées dans la boucle en dehors de la boucle 
    generateStatsPlayer($aCharacter);

    /*
    $aCharacter['health'] = rand($aCharacter['type']['min_health'], $aCharacter['type']['max_health']);
    $aCharacter['strength'] = rand($aCharacter['type']['min_strength'], $aCharacter['type']['max_strength']);
    if($aCharacter['type'] === TYPE_WIZARD ) {
        $aCharacter['magic'] = rand($aCharacter['type']['min_magic'], $aCharacter['type']['max_magic']);
    }
    */
}
unset($aCharacter);
//print_r($aCharacters);
displayPlayers($aCharacters);
echo PHP_EOL;

//3.Positionnemer (aleatoirement) les Personnages
foreach ($aCharacters as &$aCharacter) {

    /*$x = rand( 0, ( SIZE_X - 1 ) );
        $y = rand( 0, ( SIZE_Y - 1 ) );*/
    $x = $aCharacter['position']['x'];
    $y = $aCharacter['position']['y'];
    $aBoard[$y][$x] = $aCharacter;
    /*echo '[' . $x . '/' . $y . '] : ' . $aCharacter[ 'name' ] . PHP_EOL;*/
}
    echo PHP_EOL . PHP_EOL;

    //4.Affichage du tableau board en forme de grille
    displayBoard($aBoard);
    echo PHP_EOL;

    displayPlayers($aCharacters);
    echo PHP_EOL . PHP_EOL;     //print_r($aBoard);
    
    echo '== Fin du programme ==' . PHP_EOL;
