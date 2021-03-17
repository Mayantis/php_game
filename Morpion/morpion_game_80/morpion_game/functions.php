<?php
/**
 * Create a board
 *
 * @return array
 */
function createBoard(): array
{
  $board = [];

  // -- Initialisation des lignes
  for ($y = 0 ; $y < SIZE_Y ; $y++) {
      $board[ $y ] = [];

      // -- Initialisation des colonnes
      for ($x = 0 ; $x < SIZE_X ; $x++) {
          $board[ $y ][ $x ] = ' ';
      }
  }

  return $board;
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
            echo '['. $board[$y][$x] .']';
        }
        echo PHP_EOL;
    }
    echo PHP_EOL;
}

/**
 * Vérifie si les coordonnées $x, $y sont valides
 *
 * @param  int $x
 * @param  int $y
 * @return bool
 */
function isValidXY (int $x, int $y) : bool
{
    return $x >= 0 && $x < SIZE_X && $y >= 0 && $x < SIZE_Y;

    /*if (($x >= 0) && ($x < SIZE_X) && ($y >= 0) && ($x < SIZE_Y)) {
        return true;
    } else {
        return false;
    }*/
}

/**
 * @param  array $board
 * @return bool
 */
function isWin (array $board) : bool
{
    // Rappel : $board[y][x] !!

    $bLine1 = !empty(trim($board[0][0])) && ($board[0][0] === $board[0][1]) && ($board[0][1] === $board[0][2]);
    if ($bLine1) {
        echo 'Victoire de '. $board[0][0];
        return true;
    }

    $bLine2 = !empty(trim($board[1][0])) && ($board[1][0] === $board[1][1]) && ($board[1][1] === $board[1][2]);
    if ($bLine2) {
        echo 'Victoire de '. $board[1][0];
        return true;
    }

    $bLine3 = !empty(trim($board[2][0])) && ($board[2][0] === $board[2][1]) && ($board[2][1] === $board[2][2]);
    if ($bLine3) {
        echo 'Victoire de '. $board[2][0];
        return true;
    }

    $bCol1 = false/*...*/;
    $bCol2 = false/*...*/;
    $bCol3 = false/*...*/;

    $bDiaLR = false/*...*/;
    $bDiaRL = false/*...*/;
    
    /* .. */

    return false;
}