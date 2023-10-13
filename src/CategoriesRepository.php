<?php
namespace App;

use PDO;
use App\PDOConfiguration;
use App\Categorie;

class CategoriesRepository{
    public function getPDO()
    {
        $config = new PDOConfiguration(require __DIR__.'/../config/application.config.php');
        $pdo = $config->getPDO();

        return $pdo;
    }

    public function GetNameById(int $idCategory)
    {
        $pdo = $this->getPDO();
        $sql = "SELECT nom_categorie FROM categorie WHERE id_categorie = :idCategory;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idCategory', $idCategory, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

    public function getIdByName(string $routeCategory)
    {
        $pdo = $this->getPDO();
        $sql = "SELECT id_categorie FROM categorie WHERE nom_categorie = :routeCategory;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':routeCategory', $routeCategory, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

    public function getIdByArticle(string $titreArticle)
    {
        $pdo = $this->getPDO();
        $sql = "SELECT id_categorie FROM article WHERE titre_article = :titreArticle;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titreArticle', $titreArticle, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

    public function getAll()
    {
        $pdo = $this->getPDO();
        $sql = "SELECT * FROM categorie;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

}
