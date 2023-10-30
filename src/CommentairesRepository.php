<?php
namespace App;

use App\Article;
use PDO;

class CommentairesRepository extends ArticlesRepository{
    
    public function __construct(){
        
    }
    public function getByArticleId($idArticle)
    {
        $pdo = $this->getPDO();
        $sql = 'SELECT * FROM commentaire WHERE id_article = :idArticle;';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idArticle', $idArticle, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Commentaire::class);
    }

    public function getByManyArticlesIds(array $ids)
    {
        if(empty($ids)){
            return [];
        }
        $pdo = $this->getPDO();
        $idsSql = implode(',', array_values($ids));
        $sql = "SELECT * FROM commentaire WHERE id_article IN(".$idsSql.");";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Commentaire::class);

    }

    public function setCommentary(string $auteur, string $texte, int $idArticle)
    {
        $pdo = $this->getPDO();
        $sql = 'INSERT INTO commentaire (`auteur_commentaire`, `texte_commentaire`, `id_article`)
                    VALUES (":auteur_commentaire", "$texte", 2);;';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idArticle', $idArticle, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Commentaire::class);
    }
}