<?php

namespace Model\Chess;

final class Queen extends \Model\Pawn {

    protected const SYMBOL = '&#9813;';

    public function getMoves(): array
    {
        $aIsMovable = [];
        $iX = $this->x;
        $iY = $this->y;

        for ($i = 1; $i < 8; $i++) {
            $aIsMovable[0][] = [$iX + $i, $iY + $i];
            $aIsMovable[1][] = [$iX - $i, $iY - $i];
            $aIsMovable[2][] = [$iX - $i, $iY + $i];
            $aIsMovable[3][] = [$iX + $i, $iY - $i];
            $aIsMovable[4][] = [$iX + $i, $iY];
            $aIsMovable[5][] = [$iX - $i, $iY];
            $aIsMovable[6][] = [$iX, $iY + $i];
            $aIsMovable[7][] = [$iX, $iY - $i];
        }
        return $aIsMovable;
    }
}