<?php

include_once 'model/Character.php';

/*
 * Référentiel de la classe
 * Nom des classes en PascalCase
 * final = non héritable (non obligatoire)
*/
final class Wizard extends Character
{
    /*
     * Propriétés/Attributs
     * Conventions de code : camelCase 
    */
    private $magic;

    /**
     * Constructeur de la classe wizard
     * on attend un paramètre correspondant au nom
     * > obligatoire si pas présent : erreur
     */
    public function __construct(string $sName = 'Mage')
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

    /**
     * Get the value of magic
     */ 
    public function getMagic()
    {
        return $this->magic;
    }

    /**
     * Set the value of magic
     *
     * @return  self
     */ 
    public function setMagic($magic)
    {
        $this->magic = $magic;

        return $this;
    }
}