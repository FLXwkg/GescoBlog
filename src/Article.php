<?php
namespace App;

use PDO;
use App\PDOConfiguration;

class Article extends Categorie
{
    protected $articles = [];

    protected $idArticle = [];
    
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

    /*public function setIdArticles()
    {
        for($i=0;$i<count($this->articles);$i++){
            $this->idArticle[] = $this->articles[$i]['id_article'];
        };
    }*/

    public function getArticles(): array
    {
        return $this->articles;
    }

    public function getIdArticle()
    {
        return $this->idArticle;
    }


}
