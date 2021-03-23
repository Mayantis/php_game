<?php

namespace Model;
abstract class AbstractGame
{
    //** Constantes **\\

    //On défini la notion d'équipe
    public const TEAMS = [];

    //On défini la notion de dimension X etY
    protected const SIZE_X = NULL;
    protected const SIZE_Y = NULL;


    //** Propriétés / Attributs **\\

    /** @var array */
    protected array $aBoard = [];

    /** @var array */
    protected array $players = [];

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->initBoard();
    }


    //** Fonctions|Comportements **\\

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
     * @param  mixed $objet
     * @return void
     */
    protected function setCell(int $x, int $y, $objet)
    {
        $this->aBoard[$y][$x] = $objet;
    }

    protected abstract function selectCell(\Entity\Player $oPlayer, int $x, int $y): array;

    //** Getter|Setter **\\


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
     * @param  \Entity\Player $oPlayer
     * @return void
     */
    public function addPlayer(\Entity\Player $oPlayer): void
    {
        $this->players[] = $oPlayer;
    }

}
