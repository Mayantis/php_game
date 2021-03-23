<?php

namespace Model\Characters;

final class Warrior extends Character {

    protected const SYMBOL = '&#129501;';

    /**
     * __construct
     *
     * @param  mixed $sName
     * @return void
     */
    public function __construct(string $sName = 'Guerrier')
    {
        parent::__construct($sName);
        $this->maxhealth = rand(100, 120);
        $this->health = rand(50, $this->maxhealth);
        $this->strength = rand(10, 30);
        $this->name = $sName;
    }
}