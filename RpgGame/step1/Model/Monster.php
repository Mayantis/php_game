<?php 

namespace Model;

class Monster
{
    use Positionable;

    protected const SYMBOL = '&#128375;';

    public function __construct()
    {
        $this->symbol = self::SYMBOL;
    }

    public function __toString()
    {
        return $this->symbol;
    }

    public function getMoves(){
        $aIsMovable = [];
        $iX = $this->x;
        $iY = $this->y;

        $aIsMovable = [
            [$iX - 1, $iY - 1],//0
            [$iX + 1, $iY + 1],//1
            [$iX + 1, $iY - 1],//2
            [$iX - 1, $iY + 1],//3
            [$iX, $iY - 1],//4
            [$iX, $iY + 1],//5
            [$iX - 1, $iY],//6
            [$iX + 1, $iY],//7
        ];

        return $aIsMovable;
    }

}