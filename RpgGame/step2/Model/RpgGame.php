<?php

namespace Model;

Final class RpgGame extends AbstractGame
{
    //** Traits **\\


    //** Constantes **\\

    //On défini la notion d'équipe
    public const TEAMS = ['DarkCyan', 'DarkBlue'];

    //On défini la notion de dimension X etY
    protected const SIZE_X = 25;
    protected const SIZE_Y = 25;
   

    //** Propriétés|Attributs **\\

    /** @var array */
    private array $monsters;

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
        if (in_array([$x, $y], $aData['moves'])){

            //Déplacement du Personnage
            $this->moveXY($x, $y, $oCharacter);

            // Obtention des deplacements valides réactualiser
            $aData['moves']= $this->getValidMoves($oCharacter);

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
        for($i=0; $i < Monster::NB_MONSTER; $i++){
            $x = rand(0, (static::SIZE_X - 1));
            $y = rand(0, (static::SIZE_Y - 1));

            $oMonster = new Monster();
            $oMonster->setXY($x, $y);
            $this->setCell($x,$y,$oMonster);

            // On mémorise les monstres pour les récupérer plus tard
            $this->monsters[] = $oMonster;
        }
    }

    /**
     * getValidMoves
     *
     * @return array
     */
    private function getValidMoves($oPawn): array
    {
        $aValidMoves = [];

        // Récupérer les positions "envisagées" par le pion
        $aMoves = $oPawn->getMoves();
        if(!$aMoves) {
            return [];
        }

        if (is_int($aMoves[0][0])) {
            // Pour chacune, Tester si la position est valide (=libre) 
            foreach ($aMoves as $aCoords) {

                if (
                    !$this->validateCoordonate($aCoords[0], $aCoords[1])
                    || (!$this->isEmpty($aCoords[0], $aCoords[1]))
                ) {
                    continue;
                }
                // Remplir le tableau avec les coordonées valides
                $aValidMoves[] = $aCoords;
            }
        } else {

            foreach ($aMoves as $aDirection) {

                foreach ($aDirection as $aCoord) {

                    if (
                        !$this->validateCoordonate($aCoord[0], $aCoord[1])
                        || (!$this->isEmpty($aCoord[0], $aCoord[1]))
                    ) {
                        break;
                    }

                    $aValidMoves[] = $aCoord;

                    if (
                        !$this->isEmpty($aCoord[0], $aCoord[1])
                    ) {
                        break;
                    }
                }
            }
        }
        // Renvoyer le tableau des positions valides
        return $aValidMoves;
    }

    /**
     * addPlayers
     *
     * @param  \Entity\Player $oPlayer
     * @return void
     */
    public function addPlayer(\Entity\Player $oPlayer): void
    {
        parent::addPlayer($oPlayer);
        $x= rand(0, (static::SIZE_X - 1));
        $y= rand(0, (static::SIZE_Y - 1));
        $oPlayer->getCharacter()->setX($x);
        $oPlayer->getCharacter()->setY($y);
        $this->setCell($x, $y, $oPlayer->getCharacter());
    }
    
    public function moveMonsters()
    {
        foreach($this->monsters as $oMonster){
            $moves = $this->getValidMoves($oMonster);
            $x = $this->randomMoves($moves)['x'];
            $y = $this->randomMoves($moves)['y'];
            $this->moveXY($x, $y, $oMonster);
        }
    }

    public function randomMoves($moves){
        $move = $moves[array_rand($moves)];
        $x = $move[0];
        $y = $move[1];
        return ['x'=>$x,'y'=>$y];
    }
    
    public function IAmoves(){
        /**
         * Etablir quel mouvement est le meilleur pour le monstre:
         * 
         * récupérer la position du joueur
         * récupérer la position du monstre
         * comparer la position actuel du monstre a celle du joueur
         * 
         * //lignes droites
         * SI le joueur est à gauche du monstre 
         * ->se déplacer sur la gauche
         * 
         * SI le joueur est à droite du monstre
         * ->se déplacer sur la droite
         * 
         * SI le joueur est en haut du monstre
         * ->se déplacer vers le haut
         * 
         * SI le joueur est en bas du monstre
         * ->se déplacer vers le bas
         * 
         * //diagonales
         * SI le joueur est en bas à gauche du monstre 
         * ->se déplacer vers le bas ou vers la gauche ou en diagonale bas/gauche
         * 
         * SI le joueur est en bas à droite du monstre
         * ->se déplacer vers le bas ou vers la droite ou en diagonale bas/droite
         * 
         * SI le joueur est en haut à gauche du monstre
         * ->se déplacer vers le haut ou vers la gauche ou en diagonale haut/gauche
         * 
         * SI le joueur est en haut à droite du monstre
         * ->se déplacer vers le  haut ou vers la droite ou en diagonale haut/droite
         * 
         * retourne [$x, $y]
         */
    }
    
    /**
     * lifeTime
     *
     * @return void
     */
    public function lifeTime()
    {
        $this->moveMonsters();
    }

    //** Getter|Setter **\\

    /**
     * Get the value of monsters
     *
     * @return array
     */
    public function getMonsters() : array 
    {
        return $this->monsters;
    }

    /**
     * Set the value of monsters
     *
     * @param array $monsters
     *
     * @return self
     */
    public function setMonsters(array $monsters) : self
    {
        $this->monsters = $monsters;

        return $this;
    }
}
