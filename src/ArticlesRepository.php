<?php 
namespace App;

use App\Article;
use PDO;


class ArticlesRepository extends CategoriesRepository{

    public function __construct(){
        
    }
    
    public function getByCategory(int $categoryId)
    {
        $pdo = $this->getPDO();
        $sql = "SELECT * FROM article WHERE id_categorie = :categoryId;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function getAll()
    {
        $pdo = $this->getPDO();
        $sql = "SELECT * FROM article;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function getByName(string $nomArticle)
    {
        $pdo = $this->getPDO();
        $sql = "SELECT * FROM article WHERE titre_article = :nomArticle;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nomArticle', $nomArticle, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }
}