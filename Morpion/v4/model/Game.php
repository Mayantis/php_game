<?php

final class Game
{

    /** @var array */
    private array $aBoard;
   
    public const SIZE_X = 3;
    public const SIZE_Y = 3;
   
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this -> createBoard();
    }
    
    /**
     * createBoard
     *
     * @return void
     */
    private function createBoard():void
    {
        $aBoard = [];

        for ($y = 0; $y < Self::SIZE_Y; $y++) {
            $aBoard[$y] = [];
            for ($x = 0; $x < Self::SIZE_X; $x++) {
                $aBoard[$y][$x] = ' ';
            }
        }

        $this->aBoard = $aBoard;
    }
    
    /**
     * __toString
     *
     * @param  mixed $aBoard
     * @return void
     */
    public function __toString()
    {
        $sResult = '';
        for ($y = 0; $y < Self::SIZE_Y; $y++) {
            for ($x = 0; $x < Self::SIZE_X; $x++) {
                $sResult .= ' [' . $this->aBoard[$y][$x] . '] ';
            }
            $sResult .= PHP_EOL . PHP_EOL;
        }
        return $sResult;
    }

    /**
     * ValidateCoordonate
     *
     * @param  mixed $x
     * @param  mixed $y
     * @return bool
     */
    public function validateCoordonate($x, $y): bool
    {
        return (($x >= 0 && $x < Self::SIZE_X && $x !== null)
            && ($y >= 0 && $y < Self::SIZE_Y && $y !== null));
    }

    /**
     * isEmpty
     *
     * @param  mixed $x
     * @param  mixed $y
     * @return bool
     */
    public function isEmpty($x, $y): bool
    {
        //!empty(trim($oGame->board[$y][$x]))
        return (empty(trim($this->aBoard[$y][$x])));
    }

    /**
     * Winner
     *
     * @return bool
     */
    public function isWinner(): bool
    {
        $aBoard = $this->aBoard ;
        
        $bLin1 = (!empty(trim($aBoard[0][0]))) && ($aBoard[0][0] === $aBoard[0][1]) && ($aBoard[0][1] === $aBoard[0][2]);
        $bLin2 = (!empty(trim($aBoard[1][0]))) && ($aBoard[1][0] === $aBoard[1][1]) && ($aBoard[1][1] === $aBoard[1][2]);
        $bLin3 = (!empty(trim($aBoard[2][0]))) && ($aBoard[2][0] === $aBoard[2][1]) && ($aBoard[2][1] === $aBoard[2][2]);

        $bCol1 = (!empty(trim($aBoard[0][0]))) && ($aBoard[0][0] === $aBoard[1][0]) && ($aBoard[1][0] === $aBoard[2][0]);
        $bCol2 = (!empty(trim($aBoard[0][1]))) && ($aBoard[0][1] === $aBoard[1][1]) && ($aBoard[1][1] === $aBoard[2][1]);
        $bCol3 = (!empty(trim($aBoard[0][2]))) && ($aBoard[0][2] === $aBoard[1][2]) && ($aBoard[1][2] === $aBoard[2][2]);

        $bDiaLR = (!empty(trim($aBoard[0][0]))) && ($aBoard[0][0] === $aBoard[1][1]) && ($aBoard[1][1] === $aBoard[2][2]);
        $bDiaRL = (!empty(trim($aBoard[2][0]))) && ($aBoard[2][0] === $aBoard[1][1]) && ($aBoard[1][1] === $aBoard[0][2]);

        $bfullArray = (!empty(trim($aBoard[0][0])) && !empty(trim($aBoard[0][1])) && !empty(trim($aBoard[0][2]))
            && !empty(trim($aBoard[1][0])) && !empty(trim($aBoard[1][1])) && !empty(trim($aBoard[1][2]))
            && !empty(trim($aBoard[2][0])) && !empty(trim($aBoard[2][1])) && !empty(trim($aBoard[2][2])));

        $bCaseNul = $bfullArray && !$bLin1 && !$bLin2 && !$bLin3 && !$bCol1 && !$bCol2 && !$bCol3 && !$bDiaLR && !$bDiaRL;

        if ($bLin1) {
            echo $aBoard[0][0] . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bLin2) {
            echo $aBoard[1][0] . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bLin3) {
            echo $aBoard[2][0] . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bCol1) {
            echo $aBoard[0][0] . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bCol2) {
            echo $aBoard[0][1] . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bCol3) {
            echo $aBoard[0][2] . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bDiaLR) {
            echo $aBoard[0][0] . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bDiaRL) {
            echo $aBoard[2][0] . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bCaseNul) {
            echo 'Match nul' . PHP_EOL;
            return true;
        }
        return false;
    }

    /**
     * Get the value of aBoard
     */
    public function getABoard()
    {
        return $this->aBoard;
    }

    /**
     * Set the value of aBoard
     *
     * @return self
     */
    public function setABoard($aBoard): self
    {
        $this->aBoard = $aBoard;

        return $this;
    }

}