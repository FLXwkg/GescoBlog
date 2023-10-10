<?php
namespace App;

use PDO;
use App\PDOConfiguration;

class Article extends Categorie
{
    protected $articles = [];

    protected $idArticle = [];

    protected $nomArticle = [];

    public function __construct(int $AskId)
    {
        $this->setArticles($AskId);
    }

    public function setArticles(int $AskId): Article
    {
        $this->id = $AskId;
        $config = new PDOConfiguration(require __DIR__.'/../config/application.config.php');
        $pdo = $config->getPDO();
        $sql = 'SELECT * FROM article WHERE id_categorie = ' . $this->id . ';';
        $requete = $pdo->query($sql);
        $this->articles = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $this;
    }
    public function setHomeArticles(): Article
    {
        $config = new PDOConfiguration(require __DIR__.'/../config/application.config.php');
        $pdo = $config->getPDO();
        $sql = 'SELECT * FROM article;';
        $requete = $pdo->query($sql);
        $this->articles = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $this;
    }

    public function setNomArticle(string $nomArticle): Article
    {
        $this->nomArticle = $nomArticle;
        $config = new PDOConfiguration(require __DIR__.'/../config/application.config.php');
        $pdo = $config->getPDO();
        $sql = "SELECT * FROM article WHERE titre_article = '" . $this->nomArticle ."';";
        $requete = $pdo->query($sql);
        $this->articles = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $this;
    }

    public function getArticles(): array
    {
        return $this->articles;
    }

    public function getIdArticle()
    {
        return $this->idArticle;
    }

    public function getNomArticle()
    {
        return $this->articles;
    }


}
