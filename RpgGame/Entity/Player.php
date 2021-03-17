<?php
namespace Entity;
use \Model\AbstractGame;
use \Manager\DbManager;
/*Créer une classe Player*/

final class Player implements \Manager\DbManagerInterface
{

    //** Propriétés / Attributs **\\
    private const TABLE = 'players';
    /** @var int|null */
    private ?int $id;

    /** @var string */
    private string $name;

    /** @var int */
    private int $score;

    /** @var \Model\Characters\Character */
    private \Model\Characters\Character $character;

    /**
     * __construct
     *
     * @param  mixed $sName
     * @param  mixed $sSymbol
     * @return void
     */
    public function __construct(string $sName)
    {
        $this->id = null;
        $this->name = $sName;
        $this->score = 0;
    }
    
    /**
     * loadAll
     *
     * @return array
     */
    public static function loadAll(): array 
    {
        $oPdo = DbManager::getDb();
        $oStmt = $oPdo-> prepare('SELECT id, name, score FROM ' . self::TABLE . ' ORDER BY score DESC');
        $oStmt -> execute();
        $aPlayers = [];
        while($aData = $oStmt->fetch()) {
            $oPlayer = new Player($aData['name'],'');
            $oPlayer -> setScore($aData['score']);
            $aPlayers[] = $oPlayer;
        }
        return $aPlayers;
    }
        
    /**
     * get
     *
     * @param  mixed $iId
     * @return object
     */
    public static function get(int $iId): ?object 
    {
        $oPdo = DbManager::getDb();

        $oStmt = $oPdo->prepare('SELECT id, name, score FROM ' . self::TABLE . ' WHERE id = :id');
        $oStmt->bindValue(':id', $iId, \PDO::PARAM_INT);
        $oStmt->execute();

        $aData = $oStmt->fetch();

        if (!$aData) {
            // Condition de sortie : aucun utilisateur valide
            return NULL;
        }

        $oPlayer = new Player($aData['name'], '');
        $oPlayer->setId($aData['id']);
        $oPlayer->setScore($aData['score']);

        return $oPlayer;
    }
    
    /**
     * getByName
     *
     * @param  mixed $sName
     * @return object
     */
    public static function getByName (string $sName): ?object
    {
        // SELECT.. (PDO)
        $oPdo = DbManager::getDb();

        $oStmt = $oPdo->prepare('SELECT id, name, score FROM ' . self::TABLE . ' WHERE name = :name');
        $oStmt -> bindValue(':name', $sName, \PDO::PARAM_STR);
        $oStmt -> execute();

        $aData = $oStmt -> fetch();

        if(!$aData){
            // Condition de sortie : aucun utilisateur valide
            return NULL;
        }

        $oPlayer = new Player($aData['name'], '');
        $oPlayer->setId($aData['id']);
        $oPlayer->setScore($aData['score']);

        return $oPlayer;
    }
    
    /**
     * save
     *
     * @return void
     */
    public function save(): void 
    {
        $oPdo = DbManager::getDb();

        if(!$this->getId()) {    // SI le joueur n'existe pas deja dans la base de donnée
            $oStmt = $oPdo -> prepare('INSERT INTO ' . self::TABLE . '(`name`, `score`) VALUES (:name, :score)');
            $oStmt->bindValue(':name', $this->name, \PDO::PARAM_STR);
            $oStmt->bindValue(':score', $this->score, \PDO::PARAM_INT);
            $oStmt->execute();
            // On stocke l'id AUTO_INCREMENT
            $this->setId($oPdo->lastInsertId());
        }
        else{                   // SI le joueur existe dans la base de données
            $oStmt = $oPdo -> prepare('UPDATE ' . self::TABLE . ' SET `score`= :score WHERE id = :id');
            $oStmt->bindValue(':id', $this->id, \PDO::PARAM_INT);
            $oStmt->bindValue(':score', $this->score, \PDO::PARAM_INT);
            $oStmt->execute();

        }
        

        return;
    }
        
    /**
     * delete
     *
     * @return void
     */
    public function delete(): void 
    {
        $oPdo = DbManager::getDb();
        $oStmt = $oPdo->prepare('DELETE FROM ' . self::TABLE . ' WHERE id = :id');
        $oStmt->bindValue(':id', $this->getId(), \PDO::PARAM_INT);
        $oStmt->execute();
        return;
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
     * Get the value of score
     *
     * @return int
     */
    public function getScore() : int 
    {
        return $this->score;
    }

    /**
     * Set the value of score
     *
     * @param int $score
     *
     * @return self
     */
    public function setScore(int $score) : self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId() : ?int 
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of character
     *
     * @return \Model\Characters\Character
     */
    public function getCharacter() : \Model\Characters\Character 
    {
        return $this->character;
    }

    /**
     * Set the value of character
     *
     * @param \Model\Characters\Character $character
     *
     * @return self
     */
    public function setCharacter(\Model\Characters\Character $character) : self
    {
        $this->character = $character;

        return $this;
    }
}