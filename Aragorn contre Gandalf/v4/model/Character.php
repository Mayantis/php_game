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
    
    // A frappe B avec une force XX >> B perds XX points de vie    
    /**
     * hit
     *
     * @param  mixed $oPlayerB
     * @return void
     */
    public function hit(Character $oPlayerB) : void
    {
        //$strengthA = $oPlayerA -> getStrength();
        //$healthB = $oPlayerB -> getHealth();
        //$oPlayerB -> setHealth($healthB - $strengthA);
        echo $this . ' frappe ' . $oPlayerB . ' ! ' . PHP_EOL;
        $oPlayerB->setHealth( ( $oPlayerB->getHealth() ) - ($this->getStrength() ) );
        if($oPlayerB->getHealth() <= 0){
            echo $oPlayerB . ' est mort !' . PHP_EOL;
        }
    }

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
