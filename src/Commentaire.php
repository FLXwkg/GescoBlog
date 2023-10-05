<?php
namespace App;

use PDO;
use App\PDOConfiguration;

class Commentaire extends Article
{
    protected $commentaires = [];
    
    public function __construct(Article $article, int $i)
    {
        $this->setCommentaires($article,$i);
    }

    public function setCommentaires(Article $article,int $i): Commentaire
    {
        $this->articles = $article->getArticles();
        //for($i=0;$i<count($this->articles);$i++){
            $config = new PDOConfiguration(require __DIR__.'/../config/application.config.php');
            $pdo = $config->getPDO();
            $sql = 'SELECT * FROM commentaire WHERE id_article = ' . $this->articles[$i]['id_article'] . ';';
            $requete = $pdo->query($sql);
            $this->commentaires = $requete->fetchAll(PDO::FETCH_ASSOC);
        //}

        return $this;
    }

    public function getCommentaires(): array
    {
        return $this->commentaires;
    }

    public function getId()
    {
        return $this->id;
    }
}