<?php

namespace Model\Characters;

final class Wizard extends Character
{
    //** Constantes **\\
    protected const SYMBOL = '&#129497;';

    public const FIREBALL_DAMAGE = 60;
    public const FIREBALL_COST = 80;
    public const HEALHIMSELF_HEAL = 50;
    public const HEALHIMSELF_COST = 50;


    //** Propriétés|Attributs **\\

    /** @var int */
    private $magic;
    
    /**
     * __construct
     *
     * @param  mixed $sName
     * @return void
     */
    public function __construct(string $sName = 'Mage')
    {
        parent::__construct($sName);
        $this->maxhealth = rand(100,120);
        $this->health = rand(50, $this->maxhealth);
        $this->strength = rand(10,30);
        $this->magic = rand(50,100);
        $this->name = $sName;
    }


    //** Comportement|fonctions **\\
    public function getMoves(): array
    {
        $aIsMovable = [];
        $iX = $this->x;
        $iY = $this->y;

        $aIsMovable = [
                [$iX - 2, $iY - 1],
                [$iX + 2, $iY + 1],
                [$iX + 2, $iY - 1],
                [$iX - 2, $iY + 1],
                [$iX - 1, $iY - 2],
                [$iX + 1, $iY + 2],
                [$iX - 1, $iY + 2],
                [$iX + 1, $iY - 2]
            ];

        return $aIsMovable;
    }

    public function display()
    {
        print_r($this);
    }

    //** Getter|Setter **\\

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
  
    /**
     * healHimself
     * simule le lancement d'un sort qui :
     * ->restaure 50 points de vie
     * ->consomme 50 points de mana 
     * le sort "heal" est personnel 
     * (ne peut pas être lancé sur un autre joueur)
     * @return void
     */
    public function healHimself(): void
    {
        if ($this->getMagic() <= Wizard::HEALHIMSELF_COST) {
            echo $this . ' a essayé de se soigner mais il n\'a plus assez de mana pour utiliser ce sort ! ' . PHP_EOL;
            return;
        }
        echo $this . ' se soigne ! ' . PHP_EOL;
        $this->setHealth(($this->getHealth()) + Wizard::HEALHIMSELF_HEAL); 
        $this->setMagic($this->getMagic() - Wizard::HEALHIMSELF_COST);      
    }
}