<?php
namespace App;

use App\Article;
use PDO;

class CommentairesRepository extends ArticlesRepository{
    
    public function __construct(){
        
    }
    public function getByArticle(Article $article)
    {
        $pdo = $this->getPDO();
        $sql = 'SELECT * FROM commentaire WHERE id_article = :idArticle;';
        $stmt = $pdo->prepare($sql);
        $idArticle = $article->getId();
        $stmt->bindParam(':idArticle', $idArticle, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Commentaire::class);
    }
}