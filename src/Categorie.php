<?php
namespace App;

use PDO;
use App\PDOConfiguration;

class Categorie
{
    protected $categories = [];
    protected $id;
    
    public function __construct(int $AskId)
    {
        $this->setCategories($AskId);
    }

    public function setCategories(int $AskId): Categorie
    {
        $this->id = $AskId;
        $config = new PDOConfiguration(require __DIR__.'/../config/application.config.php');
        $pdo = $config->getPDO();
        $sql = 'SELECT nom_categorie FROM categorie WHERE id_categorie = ' . $this->id . ';';
        $requete = $pdo->query($sql);
        $this->categories = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $this;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getId()
    {
        return $this->id;
    }
}