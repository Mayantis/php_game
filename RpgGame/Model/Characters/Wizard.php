<?php

namespace Model\Characters;

final class Wizard extends Character
{
    //** Constantes **\\

    public const FIREBALL_DAMAGE = 60;
    public const FIREBALL_COST = 80;
    public const HEALHIMSELF_HEAL = 50;
    public const HEALHIMSELF_COST = 50;


    //** Propriétés/Attributs **\\

    private $magic;

        
    /**
     * __construct
     *
     * @param  mixed $sName
     * @return void
     */
    public function __construct(string $sName = 'Mage')
    {
        $this->name = $sName;
    }


    //** Comportement/fonctions **\\
    
    public function display()
    {
        print_r($this);
    }

    //** Getter/Setter **\\

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

    //-> Créer une fonction "fireball" pour simuler le lancement d'un sort (le sort en question occasionne 60 dégâts et consomme 80 de mana)    
    /**
     * fireball
     *
     * @param  mixed $oPlayerB
     * @return void
     */
    public function fireball(Character $oPlayerB): void
    {
        //$magicA = $oPlayerA -> getMagic();
        //$healthB = $oPlayerB -> getHealth();
        //$oPlayerA -> setMagic($magicA - $cost);
        //$oPlayerB -> setHealth($healthB - $dammage);
        if($this->getMagic() <= Wizard::FIREBALL_COST){
            echo $this . ' a essayé de lancer une boule de feu sur ' . $oPlayerB . 'mais il n\'a plus assez de mana pour utiliser ce sort ! )' . PHP_EOL;
            return;
        }
        echo $this . ' lance une boule de feu sur ' . $oPlayerB . ' ! ' . PHP_EOL;
        $oPlayerB->setHealth(($oPlayerB->getHealth()) - Wizard::FIREBALL_DAMAGE);
        $this->setMagic($this->getMagic() - Wizard::FIREBALL_COST);
        if ($oPlayerB->getHealth() <= 0) {
            echo $oPlayerB . ' est mort !';
        }
    }

    //-> Créer une fonction "heal" pour simuler le lancement d'un sort (le sort en question restaure 50 points de vie et consomme 50 de mana)(le sort "heal" est personnel et ne peut pas être lancé)    
    /**
     * healHimself
     *
     * @return void
     */
    public function healHimself(): void
    {
        //$magicA = $oPlayerA -> getMagic();
        //$healthA = $oPlayerA -> getHealth();
        //$oPlayerA -> setMagic($magicA - $cost);
        //$oPlayerA -> setHealth($healthA + $heal);
        if ($this->getMagic() <= Wizard::HEALHIMSELF_COST) {
            echo $this . ' a essayé de se soigner mais il n\'a plus assez de mana pour utiliser ce sort ! ' . PHP_EOL;
            return;
        }
        echo $this . ' se soigne ! ' . PHP_EOL;
        $this->setHealth(($this->getHealth()) + Wizard::HEALHIMSELF_HEAL);
        $this->setMagic($this->getMagic() - Wizard::HEALHIMSELF_COST);
    }
}