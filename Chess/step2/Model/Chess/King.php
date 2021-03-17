<?php

namespace Model\Chess;

final class King extends \Model\Pawn {

    protected const SYMBOL = '&#9812;';

    public function getMoves(): array
    {
        $aIsMovable = [];
        $iX = $this->x;
        $iY = $this->y;

        $aIsMovable=[ 
            [$iX - 1, $iY - 1],
            [$iX + 1, $iY + 1],
            [$iX + 1, $iY - 1],
            [$iX - 1, $iY + 1],
            [$iX, $iY - 1],
            [$iX, $iY + 1],
            [$iX - 1, $iY],
            [$iX + 1, $iY]
        ];
       
        return $aIsMovable;
    }
        
}