<?php
/**
 * createBoard
 *
 * @return array
 */
function createBoard() : array 
{
    $board = [];
    
    for ($y = 0; $y < SIZE_Y; $y++) {
        $board[$y] = [];
        for ($x = 0; $x < SIZE_X; $x++) {
            $board[$y][$x] = ' ';
        }
    }

    return $board;
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
                echo ' [ ] ';
            }
        }
        echo PHP_EOL;
        echo PHP_EOL;
    }
}