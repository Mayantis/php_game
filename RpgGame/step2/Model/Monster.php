<?php 

namespace Model;

class Monster
{
    //** Traits **\\
    
    use Positionable;


    //** Constantes **\\

    //Nombre de monstre 'Araignée' sur le plateau
    public const NB_MONSTER = 10;

    //Symbole de la classe /*&#128375;=code html de l'émoji 'Araignée' */
    protected const SYMBOL = '&#128375;';


    //** Propriétés|Attributs **\\
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->symbol = self::SYMBOL;
    }

    /**
     * __toString
     *
     * @return $this->symbol
     */
    public function __toString()
    {
        return $this->symbol;
    }


    //** Fonctions|Comportements **\\
    
    /**
     * getMoves
     * 
     * Les mouvements possibles de la classe Monster
     * 
     * @return array
     */
    public function getMoves() : array
    {
        $aIsMovable = [];
        $iX = $this->x;
        $iY = $this->y;

        $aIsMovable = [
            [$iX - 1, $iY - 1],
            [$iX + 1, $iY + 1],
            [$iX + 1, $iY - 1],
            [$iX - 1, $iY + 1],
            [$iX, $iY - 1],
            [$iX, $iY + 1],
            [$iX - 1, $iY],
            [$iX + 1, $iY],
        ];

        return $aIsMovable;
    }


    //** Getter|Setter **\\
}