<?php

namespace Model;
use \Entity\Player;

class Pawn 
{
    use Positionable;

    /** @const string  */
    protected const SYMBOL = '';

    /** @var string  */
    protected string $symbol;

    /** @var Player  */
    protected Player $player;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->symbol = static::SYMBOL;
    }

    /**
     * __toString
     *
     * @param  mixed $aBoard
     * @return void
     */
    public function __toString(){
        return $this->symbol;
    }

    public function getMoves():array
    {
        return [];
    }

    /**
     * Get the value of symbol
     *
     * @return string
     */
    public function getSymbol() : string 
    {
        return $this->symbol;
    }

    /**
     * Set the value of symbol
     *
     * @param string $symbol
     *
     * @return self
     */
    public function setSymbol(string $symbol) : self
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get the value of player
     *
     * @return Player
     */
    public function getPlayer() : Player 
    {
        return $this->player;
    }

    /**
     * Set the value of player
     *
     * @param Player $player
     *
     * @return self
     */
    public function setPlayer(Player $player) : self
    {
        $this->player = $player;

        return $this;
    }
}