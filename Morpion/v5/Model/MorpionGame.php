<?php
namespace Model;
//use \Entity\Player;

final class MorpionGame
{

    /** @var array */
    private array $aBoard;
    private array $players;
   
    private const SIZE_X = 3;
    private const SIZE_Y = 3;
    public const PAWNS=['X', 'O'];

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
    private function createBoard() : void
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
                $sResult .= ' ['; 
                if($this->aBoard[$y][$x] instanceof \Entity\Player){
                    $sResult .=  ($this->aBoard[$y][$x]) -> getSymbol();
                }
                else {
                $sResult .= ' ';
                }
                $sResult .= '] '; 
            }
            $sResult .= PHP_EOL . PHP_EOL;
        }
        return $sResult;
    }
    
    /**
     * playRound
     *
     * @param  mixed $Players
     * @return void
     */
    public function playRound() : bool
    {
        foreach ($this->players as $oPlayer) {
            echo $oPlayer->getName() . ' à vous de jouer !' . PHP_EOL;

            do {
                $sResponse = readline('>> ');
                list($x, $y) = explode(',', $sResponse);
                $bReplay = (!$this->validateCoordonate($x, $y) || !$this->isEmpty($x, $y));
                if ($bReplay) {
                    echo 'Les coordonées saisies ne sont pas valide. Veuillez ressaisir des coordonées.' . PHP_EOL;
                }
            } while ($bReplay);

            echo $x . ',' . $y . PHP_EOL . PHP_EOL;

            $this->setCell($x, $y, $oPlayer);

            echo $oPlayer . ' viens de jouer en : [' . $x . ',' . $y . '] !' . PHP_EOL;
            echo $this;

            $bWin = $this->isWinner();
            if ($bWin) {
                break;
            }
        }
        return !$bWin;
    }


    /**
     * ValidateCoordonate
     *
     * @param  mixed $x
     * @param  mixed $y
     * @return bool
     */
    public function validateCoordonate(int $x, int $y): bool
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
    public function isEmpty(int $x, int $y): bool
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
     * setCell
     *
     * @param  mixed $x
     * @param  mixed $y
     * @param  mixed $player
     * @return void
     */
    public function setCell(int $x, int $y, \Entity\Player $player) 
    {
        $this -> aBoard[$y][$x] = $player;
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

    /**
     * addPlayers
     *
     * @param  \Entity\Player $player
     * @return void
     */
    public function addPlayers(\Entity\Player $player) : void
    {
        $this -> players[] = $player;
    }

    /**
     * Get the value of Players
     *
     * @return array
     */
    public function getPlayers() : array 
    {
        return $this->players;
    }

}