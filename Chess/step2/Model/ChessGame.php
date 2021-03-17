<?php

namespace Model;

Final class ChessGame extends AbstractGame
{
    //On défini la notion d'équipe
    public const TEAMS = ['DarkCyan', 'DarkBlue'];

    //On défini la notion de dimension X etY
    protected const SIZE_X = 8;
    protected const SIZE_Y = 8;

    /** @var Pawn|null */
    protected ?Pawn $selectedPawn = null;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
    }
    
    /**
     * fillBoard
     *
     * @return void
     */
    public function fillBoard()
    {
        // Othders pawns
        $a = [0 => $this->players[1], 7 => $this->players[0]];
        foreach($a as $i => $oPlayer){
            $this->aBoard[$i][0] = (new Chess\Rook())->setPlayer($oPlayer)->setXY(0, $i);
            $this->aBoard[$i][1] = (new Chess\Knight())->setPlayer($oPlayer)->setXY(1, $i);
            $this->aBoard[$i][2] = (new Chess\Bishop())->setPlayer($oPlayer)->setXY(2, $i);
            $this->aBoard[$i][3] = (new Chess\Queen())->setPlayer($oPlayer)->setXY(3, $i);
            $this->aBoard[$i][4] = (new Chess\King())->setPlayer($oPlayer)->setXY(4, $i);
            $this->aBoard[$i][5] = (new Chess\Bishop())->setPlayer($oPlayer)->setXY(5, $i);
            $this->aBoard[$i][6] = (new Chess\Knight())->setPlayer($oPlayer)->setXY(6, $i);
            $this->aBoard[$i][7] = (new Chess\Rook())->setPlayer($oPlayer)->setXY(7, $i);
        }
       // Peons
        for ($x = 0; $x < self::SIZE_X; $x++) {
            $this->aBoard[1][$x] = (new Chess\Peon()) -> setPlayer ($this->players[1])->setXY($x, 1);
            $this->aBoard[6][$x] = (new Chess\Peon())  -> setPlayer ($this->players[0])->setXY($x, 6);
        }

        // On définit le premier joueur
        $this -> currentPlayer = $this->players[0];
    }
    
    /**
     * playerAction
     *
     * @param  mixed $oPlayer
     * @return void
     */
    protected function playerAction(\Entity\Player $oPlayer): void
    {
        do{
            // Joueur, quel pion veux-tu déplacer ? (ex : 1,1)
            $sPawnCoord = readline($oPlayer . ', quel pion veux-tu déplacer ?');
            list($x, $y) = explode(',', $sPawnCoord);

            // TEST : pion présent?
            $bRechoice = (!$this->validateCoordonate($x, $y) || $this->isEmpty($x, $y) 
                || ( $this->aBoard[$y][$x]->getPlayer() ) !== ($oPlayer) 
            );
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

    }
        
    
    /**
     * getValidMoves
     *
     * @return array
     */
    private function getValidMoves(Pawn $oPawn) :array
    {
        $aValidMoves = [];

        // Récupérer les positions "envisagées" par le pion
        $aMoves = $oPawn->getMoves();

        if(!is_array($aMoves[0][0])){
            // Pour chacune, Tester si la position est valide (=libre) 
            foreach($aMoves as $aCoords){

                if( !$this -> validateCoordonate( $aCoords[ 0 ], $aCoords[ 1 ] ) 
                        || (!$this -> isEmpty( $aCoords[ 0 ], $aCoords[ 1 ]) 
                            && ($oPawn->getPlayer() === $this->getXY($aCoords[0],$aCoords[1])->getPlayer()))) {
                        continue;
                    }
                }
                // Remplir le tableau avec les coordonées valides
                $aValidMoves[] = $aCoords;
            }
        

        else {

            foreach ($aMoves as $aDirection) {

                foreach($aDirection as $aCoord){

                    if (!$this->validateCoordonate($aCoord[0], $aCoord[1]) 
                            || (!$this->isEmpty($aCoord[0], $aCoord[1]) 
                                    && ($oPawn->getPlayer() === $this->getXY($aCoord[0],$aCoord[1])->getPlayer()) )) {
                            break;
                    }

                    $aValidMoves[] = $aCoord;

                    if(!$this->isEmpty($aCoord[0],$aCoord[1])
                    && ($this->getXY($aCoord[0], $aCoord[1])->getPlayer() !== $oPawn->getPlayer())){
                        break;
                    }
                }
            }
        }
        // Renvoyer le tableau des positions valides
        return $aValidMoves;
    }

    /**
     * selectCell
     *
     * @param  int $x
     * @param  int $y
     * @return array
     */
    public function selectCell(int $x, int $y): array
    {
        $aData = [
            'selected_pawn' => $this->selectedPawn,
            'current_player' => $this->currentPlayer,
            'is_win' => $this->isWinner(),
            'moves' => [],
        ];

        // (!$this->validateCoordonate($x, $y) || $this->isEmpty($x, $y)
            // || ($this->aBoard[$y][$x]->getPlayer()) !== ($oPlayer));
        // Coordonées invalides
        if( !$this -> validateCoordonate( $x, $y ) ) {
            return $aData;
        }

        // Est-ce que je selectione un pion ?
        $oPawn = $this -> aBoard[ $y ][ $x ];
        if( $oPawn instanceof Pawn ) {
            // Est-ce que je selectionne le bon pion ?
            if( $oPawn -> getPlayer() === $this -> currentPlayer ){
                $this -> selectedPawn = $oPawn;
                $aData['selected_pawn']=$this->selectedPawn;
                $aData['moves']=$this->getValidMoves($this->selectedPawn);
                return $aData;
            }  
        }


        // Est-ce que je deplace un pion?
        if ($this -> selectedPawn && in_array([$x, $y], $this -> getValidMoves($this->selectedPawn))){
            // Mémoriser la case de départ
            $aPositInit = $this->selectedPawn->getXY();

            // Déplacer le pion
            $this->setCell($x, $y, $this->selectedPawn);
            $this->selectedPawn->setXY($x, $y);

            // Effacer l'ancienne case
            $this->aBoard[$aPositInit['y']][$aPositInit['x']] = ' ';
            $this->selectedPawn = null;

            // Joueur suivant !
            $this->nextPlayer();
            $aData['current_player'] = $this->currentPlayer;
            return $aData;
        }

        return $aData;
    }
    
    /**
     * isWinner
     *
     * @return bool
     */
    protected function isWinner(): bool
    {
        return false;
    }
}
