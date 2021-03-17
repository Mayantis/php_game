<?php

/**
 * Display the players (of the game)
 * @param array $players
 *
 * @return void
 */
function displayPlayers(array $players): void
{
    echo '== Players ==' . PHP_EOL;
    foreach ($players as $player) {
        // sprintf : permet d'utiliser des "phrases à trous" : plus lisible
        echo sprintf(
          '%s (%s) est en %s, %s',
           $player['name'],
           $player['type']['name'],
           $player['position']['x'],
           $player['position']['y']
         );
        //echo $player['name'] . ' ('. $player['type']['name'] .')';
        //echo ' en ('. $player['position']['x'] .', '. $player['position']['y'] .')';
        echo ' [H:' . $player['health'] . '] [S:' . $player['strength'] . ']';
        if (!empty($player['magic'])) {
            echo ' [M:' . $player['magic'] . ']';
        }
        echo PHP_EOL;
    }
}

/**
 * Display the board
 * @param array $board
 *
 * @return void
 */
function displayBoard(array $board): void
{
    // -- Parcours des lignes
    for ($y = 0; $y < SIZE_Y; $y++) {
        // -- Parcours des colonnes
        for ($x = 0; $x < SIZE_X; $x++) {
            if (is_array($board[$y][$x])) {
                $aChar = $board[$y][$x];
                echo '[ ' . substr($aChar['name'], 0, 1) . ' ] ';
                // echo '['. $board[ $y ][ $x ][ 'name' ][0] .'] ';
            } else {
                echo '[' . $x . ',' . $y . '] ';
            }
        }
        echo PHP_EOL;
    }
    echo PHP_EOL;
}

/**
 * Generate character's caracteristics
 * @param  array $character (passage par COPIE de la variable)
 * @return array (on retourne le tableau modifié)
 */
function buildCaracteristicsByCopy (array $character)
{
  $character['health'] = rand ($character['type']['min_health'], $character['type']['max_health']);
  $character['strength'] = rand ($character['type']['min_strength'], $character['type']['max_strength']);
  if ($character['type'] === TYPE_WIZARD) {
    $character['magic'] = rand ($character['type']['min_magic'], $character['type']['max_magic']);
  }

  return $character;
}

/**
 * Generate character's caracteristics
 * @param  array $character (passage par REFERENCE de la variable grâce au symbole "&")
 */
function buildCaracteristicsByRef (array &$character)
{
  // On peut créer une variable intermédiaire pour rendre le code qui suit plus lisible
  $aTypeInfo = $character['type'];

  $character['health'] = rand ($aTypeInfo['min_health'], $aTypeInfo['max_health']);
  $character['strength'] = rand ($aTypeInfo['min_strength'], $aTypeInfo['max_strength']);
  if ($character['type'] === TYPE_WIZARD) {
    $character['magic'] = rand ($aTypeInfo['min_magic'], $aTypeInfo['max_magic']);
  }

  $character['position']['x'] = rand(0, SIZE_X - 1);
  $character['position']['y'] = rand(0, SIZE_Y - 1);

  // Pas besoin de return, car $character est passé par référence, du coup la variable est modifié directement dans le programme
}

// On ne ferme pas la balise PHP pour optimiser le traitement PHP
// > PHP ne perd pas de temps à "s'allumer et s'éteindre"
