<?php

/**
 * displayPlayers
 * @param array $players
 *
 * @return void
 */
function displayPlayers(array $players): void
{
    foreach ($players as $player) {
        echo $player['type'];
        echo $player['name'] . ' : [H:' . $player['health'] . '] [S:' . $player['strength'] . ']';
        if (array_key_exists('magic', $player)) {
            echo ' [M:' . $player['magic'] . ']';
        }
        echo PHP_EOL;
    }
}


/**
 * displayBoard
 * @param  array $board
 * 
 * @return void
 */
function displayBoard(array $board): void
{
    for ($y = 0; $y < SIZE_Y; $y++) {
        for ($x = 0; $x < SIZE_X; $x++) {
            if (is_array($board[$y][$x])) {
                $player = $board[$y][$x];
                echo ' (' . substr($player['name'], 0, 3) . ') ';
            } else {
                echo ' [' . $x . ';' . $y . '] ';
            }
        }
        echo PHP_EOL;
        echo PHP_EOL;
    }
}
