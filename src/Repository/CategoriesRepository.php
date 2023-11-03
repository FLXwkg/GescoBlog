<?php
namespace App\Repository;

use PDO;
use App\Entity\Categorie;

class CategoriesRepository extends BaseRepository
{
    public function getCatSlugByCatId(int $idCategory)
    {
        $sql = "SELECT slug FROM categorie WHERE id_categorie = :idCategory;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCategory', $idCategory, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

    public function getByCatId(int $idCategory)
    {
        $sql = "SELECT * FROM categorie WHERE id_categorie = :idCategory;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCategory', $idCategory, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

    public function getIdByName(string $routeCategory)
    {

        $sql = "SELECT id_categorie FROM categorie WHERE nom_categorie = :routeCategory;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':routeCategory', $routeCategory, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

    public function getCatIdBySlugArticle(string $slugArticle)
    {
        
        $sql = "SELECT id_categorie FROM article WHERE slug = :slugArticle;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':slugArticle', $slugArticle, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categorie;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

}
