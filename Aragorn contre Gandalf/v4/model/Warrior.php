<?php

include_once 'model/Character.php';

/*
 * Référentiel de la classe
 * Nom des classes en PascalCase
 * extends = hérite des propriétés publics/protégées (UN SEUL HERITAGE POSSIBLE A LA FOIS)
*/

final class Warrior extends Character {

    /**
     * Constructeur de la classe warrior
     * on attend un paramètre correspondant au nom
     * > si pas présent : erreur
     */
    public function __construct(string $sName = 'Guerrier')
    {
        $this->name = $sName;
    }
    
    /*
     * Comportement/fonctions
     * Conventions de code : camelCase
    */
    public function display()
    {
        print_r($this);
    }

}