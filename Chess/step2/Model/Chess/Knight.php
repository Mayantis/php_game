<?php

namespace Model\Chess;

final class Knight extends \Model\Pawn {

    protected const SYMBOL = '&#9816;';

    public function getMoves(): array
    {
        $aIsMovable = [];
        $iX = $this->x;
        $iY = $this->y;

        $aIsMovable = [
            [$iX - 2, $iY - 1],
            [$iX + 2, $iY + 1],
            [$iX + 2, $iY - 1],
            [$iX - 2, $iY + 1],
            [$iX - 1, $iY - 2],
            [$iX + 1, $iY + 2],
            [$iX - 1, $iY + 2],
            [$iX + 1, $iY - 2]
        ];

        return $aIsMovable;
    }

}