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
            $case = $board[$y][$x];
            echo ' [' . $case . '] ';
        }
        echo PHP_EOL;
        echo PHP_EOL;
    }
}

/**
 * ValidateCoordonate
 *
 * @param  mixed $x
 * @param  mixed $y
 * @return bool
 */
function ValidateCoordonate($x,$y) : bool
{
    return(($x >= 0 && $x < SIZE_X && $x !== null)
        && ($y >= 0 && $y < SIZE_Y && $y !== null));
}


/**
 * Winner
 *
 * @param  mixed $board
 * @return bool
 */
function Winner(array $board) : bool
{
    $bLin1 = ( !empty( trim($board[0][0]) )) && ($board[0][0] === $board[0][1]) && ($board[0][1] === $board[0][2]);
    $bLin2 = ( !empty( trim($board[1][0]))) && ($board[1][0] === $board[1][1]) && ($board[1][1] === $board[1][2]);
    $bLin3 = ( !empty( trim($board[2][0]))) && ($board[2][0] === $board[2][1]) && ($board[2][1] === $board[2][2]);

    $bCol1 = ( !empty( trim($board[0][0]))) && ($board[0][0] === $board[1][0]) && ($board[1][0] === $board[2][0]);
    $bCol2 = ( !empty( trim($board[0][1]))) && ($board[0][1] === $board[1][1]) && ($board[1][1] === $board[2][1]);
    $bCol3 = ( !empty( trim($board[0][2]))) && ($board[0][2] === $board[1][2]) && ($board[1][2] === $board[2][2]);

    $bDiaLR = ( !empty( trim($board[0][0]))) && ($board[0][0] === $board[1][1]) && ($board[1][1] === $board[2][2]);
    $bDiaRL = ( !empty( trim($board[2][0]))) && ($board[2][0] === $board[1][1]) && ($board[1][1] === $board[0][2]);

    $bfullArray = (
        !empty(trim($board[0][0])) && !empty(trim($board[0][1])) && !empty(trim($board[0][2])) 
     && !empty(trim($board[1][0])) && !empty(trim($board[1][1])) && !empty(trim($board[1][2])) 
     && !empty(trim($board[2][0])) && !empty(trim($board[2][1])) && !empty(trim($board[2][2]))
    );

    $bCaseNul = $bfullArray && !$bLin1 && !$bLin2 && !$bLin3 && !$bCol1 && !$bCol2 && !$bCol3 && !$bDiaLR && !$bDiaRL;

    if($bLin1){
        echo $board[0][0] . ' à gagné' . PHP_EOL;
        return true;
    }

    if ($bLin2) {
        echo $board[1][0] . ' à gagné' . PHP_EOL;
        return true;
    }

    if ($bLin3) {
        echo $board[2][0] . ' à gagné' . PHP_EOL;
        return true;
    }

    if ($bCol1) {
        echo $board[0][0] . ' à gagné' . PHP_EOL;
        return true;
    }

    if ($bCol2) {
        echo $board[0][1] . ' à gagné' . PHP_EOL;
        return true;
    }

    if ($bCol3) {
        echo $board[0][2] . ' à gagné' . PHP_EOL;
        return true;
    }

    if ($bDiaLR) {
        echo $board[0][0] . ' à gagné' . PHP_EOL;
        return true;
    }

    if ($bDiaRL) {
        echo $board[2][0] . ' à gagné' . PHP_EOL;
        return true;
    }

    if ($bCaseNul) {
        echo 'Match nul' . PHP_EOL;
        return true;
    }
 return false;
}

    

    /**la victoire est attribué au joueur qui arrive a remplir 3 cases alignés
     * Il y a donc 8 possibilitées de victoires :
     * -> Le joueur (X/O) 'possède' la colonne 1 :
     * if(  $board[0][0]==$player 
     *      && $board[0][1]==$player 
     *      && $board[0][2]==$player
     *   ){
     *     echo $player . 'à gagné';
     *   }
     * -> Le joueur (X/O) 'possède' la colonne 2:
     * if(  $board[1][0]==$player 
     *      && $board[1][1]==$player 
     *      && $board[1][2]==$player
     *   ){
     *     echo $player . 'à gagné';
     *   }
     * -> Le joueur (X/O) 'possède' la colonne 3:
     * if(  $board[2][0]==$player 
     *      && $board[2][1]==$player 
     *      && $board[2][2]==$player
     *   ){
     *     echo $player . 'à gagné';
     *   }
     * -> Le joueur (X/O) 'possède' la ligne 1:
     * if(  $board[0][0]==$player 
     *      && $board[1][0]==$player 
     *      && $board[2][0]==$player
     *   ){
     *     echo $player . 'à gagné';
     *   }
     * -> Le joueur (X/O) 'possède' la ligne 2:
     * if(  $board[0][1]==$player 
     *      && $board[1][1]==$player 
     *      && $board[2][1]==$player
     *   ){
     *     echo $player . 'à gagné';
     *   }
     * -> Le joueur (X/O) 'possède' la ligne 3
     * if(  $board[0][2]==$player 
     *      && $board[1][2]==$player 
     *      && $board[2][2]==$player
     *   ){
     *     echo $player . 'à gagné';
     *   }
     * -> Le joueur (X/O) 'possède' la diagonale haut gauche-bas droit
     * if(  $board[0][0]==$player 
     *      && $board[1][1]==$player 
     *      && $board[2][2]==$player
     *   ){
     *     echo $player . 'à gagné';
     *   }
     * -> Le joueur (X/O) 'possède' la digonale haut droit-bas gauche
     * if(  $board[2][0]==$player 
     *      && $board[1][1]==$player 
     *      && $board[0][2]==$player
     *   ){
     *     echo $player . 'à gagné';
     *   }
     * Si aucun cas n'est vrai après 9 tour : match nul
     * 
     * 
     */ 
    
   

