<?php

namespace Model\Characters;

abstract class Character extends \Model\Pawn
{
    //** Propriétés|Attributs **\\
    
    /** @var string */
    protected $name;

    /** @var int */
    protected $health;

    /** @var int */
    protected $strength;
    

    //** Fonctions|Comportements **\\

    /**
     * __construct
     *
     * @param  mixed $sName
     * @return void
     */
    public function __construct(string $sName)
    {
        parent::__construct();
        $this->name = $sName;
    }

    public function getMoves(): array
    {
        $aIsMovable = [];
        $iX = $this->x;
        $iY = $this->y;

        $aIsMovable = [
            [$iX, $iY - 1],
            [$iX, $iY + 1],
            [$iX - 1, $iY],
            [$iX + 1, $iY]
        ];

        return $aIsMovable;
    }



    //** Getter & Setter **\\

    /**
     * Get /*
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set /*
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Get the value of health
     */ 
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Set the value of health
     *
     * @return  self
     */ 
    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Get the value of strength
     */ 
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Set the value of strength
     *
     * @return  self
     */ 
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

}
