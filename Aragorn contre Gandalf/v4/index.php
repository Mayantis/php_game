<?php

//Affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Inclusion des fichiers
include_once 'model/Character.php';
include_once 'model/Warrior.php';
include_once 'model/Wizard.php';

/*
$aAragorn = array(
    'name'     => 'Aragorn',
    'health'   => 100,
    'strength' => 50,
);
display($aragorn);

function display(array $aCharacter)
{
    print_r($aCharacter);
}
*/

$oAragorn = new Warrior;
//$oAragorn -> name = 'Aragorn';
$oAragorn->setName('Aragorn');
$oAragorn -> setHealth('150');
$oAragorn -> setStrength('50');
// appel de la fonction personnalisée "display"
$oAragorn -> display();
//echo $oAragorn . PHP_EOL;

/************************************/

$oGandalf = new Wizard;
$oGandalf ->setName('Gandalf');
$oGandalf ->setHealth('70');
$oGandalf ->setStrength('20');
$oGandalf -> setMagic('200');
//echo = appel de la fonction __toString
//echo $oGandalf . PHP_EOL;
$oGandalf->display();

$oWar = new Warrior();
$oWiz = new Wizard();

echo '=============Début du combat=============' . PHP_EOL . PHP_EOL;

$oAragorn -> hit($oGandalf);
$oAragorn->display();
$oGandalf->display();
echo PHP_EOL;

$oGandalf->healHimself();
$oGandalf->display();
echo PHP_EOL;

$oAragorn->hit($oGandalf);
$oAragorn->display();
$oGandalf->display();
echo PHP_EOL;

$oGandalf->fireball($oAragorn);
$oAragorn->display();
$oGandalf->display();
echo PHP_EOL;

$oAragorn->hit($oGandalf);
$oAragorn->display();
$oGandalf->display();
echo PHP_EOL;
echo PHP_EOL .'=============Fin du combat=============' ;
