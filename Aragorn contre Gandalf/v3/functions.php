<?php

/**
 * displayStatsPlayer
 *
 * @param  mixed $aplayer
 * @return void
 */
function generateStatsPlayer(array &$aplayer) : void
{
    $playerType= $aplayer['type'];
    $aplayer['health'] = rand($playerType['min_health'], $playerType['max_health']);
    $aplayer['strength'] = rand($playerType['min_strength'], $playerType['max_strength']);
    if ($aplayer['type'] === TYPE_WIZARD) {
        $aplayer['magic'] = rand($playerType['min_magic'], $playerType['max_magic']);
    }

    $aplayer['position']['x'] = rand(0, (SIZE_X - 1));
    $aplayer['position']['y'] = rand(0, (SIZE_Y - 1));;
} 

/**
 * displayPlayers
 * @param array $players
 *
 * @return void
 */
function displayPlayers(array $players): void
{
    foreach ($players as $player) {
        echo sprintf(
            '%s : %s %sStats : [H: %d ] [S: %d]',
            $player['name'],
            $player['type']['name'],
            PHP_EOL,
            $player['health'],
            $player['strength']
        );
        if (array_key_exists('magic', $player)) {
            echo ' [M:' . $player['magic'] . ']';
        }
        echo PHP_EOL . 'Positon : [' . $player['position']['x'] . ';' . $player['position']['y'] . ']';

        echo PHP_EOL . PHP_EOL;
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
