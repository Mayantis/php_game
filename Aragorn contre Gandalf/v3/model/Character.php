<?php
/*
 * Référentiel de la classe
 * Nom des classes en PascalCase
 * abstract = il n'y aura pas de nouveau Character
*/

abstract class Character
{
    /*
     * Propriétés/Attributs
     * Conventions de code : camelCase 
    */

    protected $name;
    protected $health;
    protected $strength;

    /**
     * Fonction spéciale permettant de convertir votre objet en 
     * chaîne de caractère (via echo par exemple)
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get /*
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set /*
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of health
     */ 
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Set the value of health
     *
     * @return  self
     */ 
    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Get the value of strength
     */ 
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Set the value of strength
     *
     * @return  self
     */ 
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }
}