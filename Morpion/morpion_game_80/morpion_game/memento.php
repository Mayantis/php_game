<?php
// Character.php
abstract class Character 
{
    // On défini une constante de classe publique
    public const TOTO = 2;

    /** @var string */
    protected string $name;

    /** 
     * On défini la santé du joueur, avec une valeur par défaut (ici 50)
     * @var int
     */
    protected int $health = 50;

    public function __construct()
    {
    }

    /**
     * Appeler lors du echo
     * @return string
     */
    public function __toString() : string
    {
        return $this->name  . ' [H: '. $this->health.']';
    }
}

// Wizard.php
final class Wizard extends Character
{
    /** @var int */
    protected int $magic;

    /**
     * Appeler lors du echo
     * @return string
     */
    public function __toString() : string
    {
        // parent:: permet d'accéder à des informations public/protégées de la classe parente
        return parent::__toString() . ' [S: '. $this->magic.']';
    }
}

// index.php
$oWiz = new Wizard();

// PHP va essayer d'appeler __toString sur Wizard (si la fonction n'existe pas, il ira voir sur Character si jamais elle existe)
echo $oWiz;

// PHP va chercher la constante TOTO sur Character (si accessible -publique-)
echo Character::TOTO;