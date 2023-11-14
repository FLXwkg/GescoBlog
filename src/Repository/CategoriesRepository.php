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

    public function findOneBySlug(string $routeCategory): ?Categorie
    {
        $sql = "SELECT * FROM categorie WHERE nom_categorie = :routeCategory LIMIT 1;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':routeCategory', $routeCategory, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Categorie::class);
        // Fetch a single row as an object of the Categorie class
        $result = $stmt->fetch(PDO::FETCH_CLASS, PDO::FETCH_ORI_NEXT, 0);

        // Return the result or null if no row was found
        return $result !== false ? $result : null;
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
