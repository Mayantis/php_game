<?php
namespace Model;
//use \Entity\Player;

final class MorpionGame extends AbstractGame
{
    //On défini la notion d'équipe
    public const TEAMS = ['X', 'O'];

    //On défini la notion de dimension X etY
    protected const SIZE_X = 3;
    protected const SIZE_Y = 3;
    
    /**
     * playerAction
     *
     * @param  mixed $oPlayer
     * @return void
     */
    public function playerAction(\Entity\Player $oPlayer) : void
    {
        do {
            $sResponse = readline('>> ');
            list($x, $y) = explode(',', $sResponse);
            $bReplay = (!$this->validateCoordonate($x, $y) || !$this->isEmpty($x, $y));
            //$bReplay = !AbstractGame::validateCoordonate($x, $y) || !$this->isEmpty($x, $y));
            if ($bReplay) {
                echo 'Les coordonées saisies ne sont pas valide. Veuillez ressaisir des coordonées.' . PHP_EOL;
            }
        } while ($bReplay);

        echo $x . ',' . $y . PHP_EOL . PHP_EOL;

        $oPawn = (new Pawn())
            ->setPlayer($oPlayer)
            ->setSymbol($oPlayer->getTeam());
        $this->setCell($x, $y, $oPawn);
        echo $oPlayer . ' viens de jouer en : [' . $x . ',' . $y . '] !' . PHP_EOL;
    }

    /**
     * Winner
     *
     * @return bool
     */
    public function isWinner(): bool
    {
        $aBoard = $this->aBoard ;
        
        $bLin1 = (!empty(trim($aBoard[0][0]))) && ($aBoard[0][0] == $aBoard[0][1]) && ($aBoard[0][1] == $aBoard[0][2]);
        $bLin2 = (!empty(trim($aBoard[1][0]))) && ($aBoard[1][0] == $aBoard[1][1]) && ($aBoard[1][1] == $aBoard[1][2]);
        $bLin3 = (!empty(trim($aBoard[2][0]))) && ($aBoard[2][0] == $aBoard[2][1]) && ($aBoard[2][1] == $aBoard[2][2]);

        $bCol1 = (!empty(trim($aBoard[0][0]))) && ($aBoard[0][0] == $aBoard[1][0]) && ($aBoard[1][0] == $aBoard[2][0]);
        $bCol2 = (!empty(trim($aBoard[0][1]))) && ($aBoard[0][1] == $aBoard[1][1]) && ($aBoard[1][1] == $aBoard[2][1]);
        $bCol3 = (!empty(trim($aBoard[0][2]))) && ($aBoard[0][2] == $aBoard[1][2]) && ($aBoard[1][2] == $aBoard[2][2]);

        $bDiaLR = (!empty(trim($aBoard[0][0]))) && ($aBoard[0][0] == $aBoard[1][1]) && ($aBoard[1][1] == $aBoard[2][2]);
        $bDiaRL = (!empty(trim($aBoard[2][0]))) && ($aBoard[2][0] == $aBoard[1][1]) && ($aBoard[1][1] == $aBoard[0][2]);

        $bfullArray = (!empty(trim($aBoard[0][0])) && !empty(trim($aBoard[0][1])) && !empty(trim($aBoard[0][2]))
            && !empty(trim($aBoard[1][0])) && !empty(trim($aBoard[1][1])) && !empty(trim($aBoard[1][2]))
            && !empty(trim($aBoard[2][0])) && !empty(trim($aBoard[2][1])) && !empty(trim($aBoard[2][2])));

        $bCaseNul = $bfullArray && !$bLin1 && !$bLin2 && !$bLin3 && !$bCol1 && !$bCol2 && !$bCol3 && !$bDiaLR && !$bDiaRL;

        if ($bLin1) {
            echo $aBoard[0][0]->getPlayer() . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bLin2) {
            echo $aBoard[1][0]->getPlayer() . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bLin3) {
            echo $aBoard[2][0]->getPlayer() . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bCol1) {
            echo $aBoard[0][0]->getPlayer() . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bCol2) {
            echo $aBoard[0][1]->getPlayer() . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bCol3) {
            echo $aBoard[0][2]->getPlayer() . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bDiaLR) {
            echo $aBoard[0][0]->getPlayer() . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bDiaRL) {
            echo $aBoard[2][0]->getPlayer() . ' à gagné' . PHP_EOL;
            return true;
        }

        if ($bCaseNul) {
            echo 'Match nul' . PHP_EOL;
            return true;
        }
        return false;
    }
    
    /**
     * checkWin
     *
     * @param  mixed $aListCoords
     * @return bool
     */
    private function checkWin(array $aListCoords) : bool
    {
        return true;
    }
    
}