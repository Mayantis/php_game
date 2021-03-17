<?php
namespace Entity;
/*Créer une classe Player

1. Au lieu des joueurs 'X' et '0', créer 2 instances de Player en leur donnant un PSEUDO et un SYMBOLE (X/O)
N'oubliez pas de respecter les conventions de nommage

2. Demander à l'utilisateur le nom des joueurs
== Paramétrage du jeu ==
> Saisir le nom du joueur 1 : xxxxx
> Saisir le nom du joueur 2 : xxxxx

== Démarrage de la partie ==
[ ] [ ] [ ]
...
*/

class Player 
{
    /** @var string */
    private string $name;

    /** @var string */
    private string $team;

    /**
     * __construct
     *
     * @param  mixed $sName
     * @param  mixed $sSymbol
     * @return void
     */
    public function __construct(string $sName, $sTeam )
    {
        $this->name = $sName;
        $this->team = $sTeam;
    }
    
    /**
     * __toString
     *
     * @return void
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return self
     */
    public function setName($name) : self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of symbol
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set the value of symbol
     *
     * @return self
     */
    public function setTeam($team) : self
    {
        $this->team = $team;

        return $this;
    }
}