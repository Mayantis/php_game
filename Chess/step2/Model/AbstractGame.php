<?php

namespace Model;

/**

 */

abstract class AbstractGame
{
    //On défini la notion d'équipe
    public const TEAMS = [];

    //On défini la notion de dimension X etY
    protected const SIZE_X = NULL;
    protected const SIZE_Y = NULL;

    /** @var array */
    protected array $aBoard = [];

    /** @var array */
    protected array $players = [];

    /** @var \Entity\Player|null */
    protected ?\Entity\Player $currentPlayer = null;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->initBoard();
    }

    /**
     * createBoard
     *
     * @return void
     */
    private function initBoard(): void
    {
        $aBoard = [];

        for (
            $y = 0;
            $y < static::SIZE_Y;
            $y++
        ) {
            $aBoard[$y] = [];
            for ($x = 0; $x < static::SIZE_X; $x++) {
                $aBoard[$y][$x] = ' ';
            }
        }

        $this->aBoard = $aBoard;
    }

    /**
     * ValidateCoordonate
     *
     * @param  mixed $x
     * @param  mixed $y
     * @return bool
     */
    protected function validateCoordonate(int $x, int $y): bool
    {
        return (($x >= 0 && $x < static::SIZE_X && $x !== null)
            && ($y >= 0 && $y < static::SIZE_Y && $y !== null));
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
        for ($y = 0; $y < static::SIZE_Y; $y++) {
            for ($x = 0; $x < static::SIZE_X; $x++) {
                $sResult .= ' [' . $this->aBoard[$y][$x] . '] ';
            }
            $sResult .= PHP_EOL . PHP_EOL;
        }
        return $sResult;
    }

    /**
     * isEmpty
     *
     * @param  mixed $x
     * @param  mixed $y
     * @return bool
     */
    protected function isEmpty(int $x, int $y): bool
    {
        //!empty(trim($oGame->board[$y][$x]))
        return (empty(trim($this->aBoard[$y][$x])));
    }

    protected function getXY(int $x, int $y)
    {
        return $this->aBoard[$y][$x];
    }

    /**
     * setCell
     *
     * @param  mixed $x
     * @param  mixed $y
     * @param  mixed $player
     * @return void
     */
    protected function setCell(int $x, int $y, Pawn $pawn)
    {
        $this->aBoard[$y][$x] = $pawn;
    }

    /**
     * playRound
     *
     * @param  mixed $Players
     * @return void
     */
    public function playRound(): bool
    {
        foreach ($this->players as $oPlayer) {
            echo $oPlayer->getName() . ' à vous de jouer !' . PHP_EOL;
            $oPlayer -> save();
            //Le joueur joue
            $this->PlayerAction($oPlayer);

            echo $this . PHP_EOL;

            $bWin = $this->isWinner();
            if ($bWin) {
                break;
            }
        }
        return !$bWin;
    }

    protected abstract function playerAction(\Entity\Player $oPlayer): void;

    protected abstract function selectCell(int $x, int $y): array;

    protected abstract function isWinner(): bool;

    protected function nextPlayer(): void
    {
        // $this -> players = tableau de joueurs
        // $this -> currentPlayer = joueur actuel

        // in_array ($value , $array)           bool
        // array_search ($value , $array)       int (=index) ou false

        $iIdxPlayer = array_search( $this->currentPlayer, $this->players );
        if( $iIdxPlayer !== FALSE){
            $iIdxPlayer++;
            $iNbPlayers = count($this->players);

            // Solution 1:
                /*
                if ($iIdxPlayer >= $iNbPlayers){
                    $iIdxPlayer=0;
                }
                $this->currentPlayer = $this->players[$iIdxPlayer];
                */

            // Solution 2: (%(modulo) = reste de la division : a / b)
            $this->currentPlayer = $this->players[$iIdxPlayer % $iNbPlayers];
        }
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
     * Get the value of Players
     *
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * Set the value of players
     *
     * @param array $players
     *
     * @return self
     */
    public function setPlayers(array $players): self
    {
        $this->players = $players;

        return $this;
    }

    /**
     * addPlayers
     *
     * @param  \Entity\Player $player
     * @return void
     */
    public function addPlayers(\Entity\Player $player): void
    {
        $this->players[] = $player;
    }

    /**
     * Get the value of currentPlayer
     *
     * @return ?\Entity\Player
     */
    public function getCurrentPlayer() : ?\Entity\Player 
    {
        return $this->currentPlayer;
    }

    /**
     * Set the value of currentPlayer
     *
     * @param ?\Entity\Player $currentPlayer
     *
     * @return self
     */
    public function setCurrentPlayer(?\Entity\Player $currentPlayer) : self
    {
        $this->currentPlayer = $currentPlayer;

        return $this;
    }
}
