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
}
