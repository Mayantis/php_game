<?php

namespace Model;

Final class ChessGame extends AbstractGame
{
    //On défini la notion d'équipe
    public const TEAMS = ['Whites', 'Blacks'];

    //On défini la notion de dimension X etY
    protected const SIZE_X = 8;
    protected const SIZE_Y = 8;

    public function __construct()
    {
        parent::__construct();
        
    }

    public function fillBoard()
    {
        // Othders pawns
        $a = [0 => $this->players[0], 7 => $this->players[1]];
        foreach($a as $i => $oPlayer){
            $this->aBoard[$i][0] = (new Chess\Rook())->setPlayer($oPlayer);
            $this->aBoard[$i][1] = (new Chess\Knight())->setPlayer($oPlayer);
            $this->aBoard[$i][2] = (new Chess\Bishop())->setPlayer($oPlayer);
            $this->aBoard[$i][3] = (new Chess\Queen())->setPlayer($oPlayer);
            $this->aBoard[$i][4] = (new Chess\King())->setPlayer($oPlayer);
            $this->aBoard[$i][5] = (new Chess\Bishop())->setPlayer($oPlayer);
            $this->aBoard[$i][6] = (new Chess\Knight())->setPlayer($oPlayer);
            $this->aBoard[$i][7] = (new Chess\Rook())->setPlayer($oPlayer);
        }
       // Peons
        for ($x = 0; $x < self::SIZE_X; $x++) {
            $this->aBoard[1][$x] = (new Chess\Peon()) -> setPlayer ($this->players[0]);
            $this->aBoard[6][$x] = (new Chess\Peon())  -> setPlayer ($this->players[1]);
        }
    }

    protected function playerAction(\Entity\Player $oPlayer): void
    {
        do{
            // Joueur, quel pion veux-tu déplacer ? (ex : 1,1)
            $sPawnCoord = readline($oPlayer . ', quel pion veux-tu déplacer ?');
            list($x, $y) = explode(',', $sPawnCoord);

            // TEST : pion présent?
            $bRechoice = (!$this->validateCoordonate($x, $y) || $this->isEmpty($x, $y));
            if ($bRechoice) {
                echo 'Les coordonées saisies ne sont pas valide. Veuillez ressaisir des coordonées.' . PHP_EOL;
            }
            
        }while($bRechoice);

        do {
            // Joueur, où veux tu le déplacer ? (ex : 1,2)
            $sPawnDest = readline($oPlayer . ', ou veux tu deplacer le pion : (TODO:nom du pion) ?');
            list($newX, $newY) = explode(',', $sPawnDest);
            $bReplay = (!$this->validateCoordonate($newX, $newY));
            
        }while($bReplay);

        $oPawn = $this->aBoard[$y][$x];
        $this->setCell($newX, $newY, $oPawn);
        $this->aBoard[$y][$x]=' ';
        //readline('STOP');

        /*
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
        /*
        $oPawn = (new Pawn())
            ->setPlayer($oPlayer)
            ->setSymbol($oPlayer->getTeam());
        $this->setCell($x, $y, $oPawn);
        */
       /* echo $oPlayer . ' viens de jouer en : [' . $x . ',' . $y . '] !' . PHP_EOL;*/
    }

    protected function isWinner(): bool
    {
        return false;
    }
}
