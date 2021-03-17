<?php

namespace Model\Chess;

final class Peon extends \Model\Pawn {

    protected const SYMBOL = '&#9817;';

    public function getMoves(): array
    {
        $aIsMovable = [0=>[],];
        $iX = $this->x;
        $iY = $this->y;

        switch ($this->getPlayer()->getTeam()) {
            //Pion Blanc
            case \Model\ChessGame::TEAMS[0]:
                $aIsMovable[0][] = [$iX, $iY - 1];
                if ($iY == 6) {
                    $aIsMovable[0][] = [$iX, $iY - 2];
                }
            break;

            //Pion Noir
            case \Model\ChessGame::TEAMS[1]:
                $aIsMovable[0][] = [$iX, $iY + 1];
                if ($iY == 1) {
                    $aIsMovable[0][] = [$iX, $iY + 2];
                }
            break;
        }
        
        return $aIsMovable;
    }
}