<?php

namespace Model;

Final class RpgGame extends AbstractGame
{
    //** Constantes **\\

    //On défini la notion d'équipe
    public const TEAMS = ['DarkCyan', 'DarkBlue'];

    //On défini la notion de dimension X etY
    protected const SIZE_X = 25;
    protected const SIZE_Y = 25;


    //** Propriétés|Attributs **\\

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
    }


    //** Fonctions|Comportements **\\

    /**
     * selectCell
     *
     * @param \Entity\Player $oPlayer
     * @param  int $x
     * @param  int $y
     * @return array
     */
    public function selectCell(\Entity\Player $oPlayer,int $x, int $y): array
    {
        $aData = [
            'moves' => [],
        ];

        // Coordonées invalides
        if( !$this -> validateCoordonate( $x, $y ) ) {
            return $aData;
        }

        $oCharacter = $oPlayer->getCharacter();

        // Validation des déplacements par RpgGame
        $aData['moves']=$this->getValidMoves($oCharacter);

        // Déplacement autorisé?
        if (in_array([$x, $y], $this -> getValidMoves($oCharacter))){
            // Mémoriser la case de départ
            $aPositInit = $oCharacter->getXY();

            // Déplacer le pion
            $this->setCell($x, $y, $oCharacter);
            $oCharacter->setXY($x, $y);

            // Effacer l'ancienne case
            $this->aBoard[$aPositInit['y']][$aPositInit['x']] = ' ';

            return $aData;
        }

        return $aData;
    }

    /**
     * fillBoard
     *
     * @return void
     */
    public function fillBoard()
    {
    }

    /**
     * getValidMoves
     *
     * @return array
     */
    private function getValidMoves(Pawn $oPawn): array
    {
        $aValidMoves = [];

        // Récupérer les positions "envisagées" par le pion
        $aMoves = $oPawn->getMoves();

        if (!is_array($aMoves[0][0])) {
            // Pour chacune, Tester si la position est valide (=libre) 
            foreach ($aMoves as $aCoords) {

                if (
                    !$this->validateCoordonate($aCoords[0], $aCoords[1])
                    || (!$this->isEmpty($aCoords[0], $aCoords[1])
                        && ($oPawn->getPlayer() === $this->getXY($aCoords[0], $aCoords[1])->getPlayer()))
                ) {
                    continue;
                }
            }
            // Remplir le tableau avec les coordonées valides
            $aValidMoves[] = $aCoords;
        } else {

            foreach ($aMoves as $aDirection) {

                foreach ($aDirection as $aCoord) {

                    if (
                        !$this->validateCoordonate($aCoord[0], $aCoord[1])
                        || (!$this->isEmpty($aCoord[0], $aCoord[1])
                            && ($oPawn->getPlayer() === $this->getXY($aCoord[0], $aCoord[1])->getPlayer()))
                    ) {
                        break;
                    }

                    $aValidMoves[] = $aCoord;

                    if (
                        !$this->isEmpty($aCoord[0], $aCoord[1])
                        && ($this->getXY($aCoord[0], $aCoord[1])->getPlayer() !== $oPawn->getPlayer())
                    ) {
                        break;
                    }
                }
            }
        }
        // Renvoyer le tableau des positions valides
        return $aValidMoves;
    }

    //** Getter|Setter **\\

}
