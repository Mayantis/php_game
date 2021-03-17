<?php

namespace Model\Chess;

final class Rook extends \Model\Pawn {

    protected const SYMBOL = '&#9814;';

    public function getMoves(): array
    {
        $aIsMovable = [];
        $iX = $this->x;
        $iY = $this->y;

        for ($i = 1; $i < 8; $i++) {
            $aIsMovable[0][] = [$iX + $i, $iY];
            $aIsMovable[1][] = [$iX - $i, $iY];
            $aIsMovable[2][] = [$iX, $iY + $i];
            $aIsMovable[3][] = [$iX, $iY - $i];
        }
        return $aIsMovable;
    }
        
}