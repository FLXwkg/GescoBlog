<?php
namespace App\Repository;

use PDO;
use App\Entity\Categorie;

class CategoriesRepository extends BaseRepository
{
    /**
     * @param int $idCategory
     * @return array[Categorie] 
     */
    public function getByCatId(int $idCategory): array
    {
        $sql = "SELECT * FROM categorie WHERE id_categorie = :idCategory;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCategory', $idCategory, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

    /**
     * @param string $slugCategory
     * @return Categorie|null
     */
    public function findOneBySlug(string $slugCategory): ?Categorie
    {
        $sql = "SELECT * FROM categorie WHERE slug = :slugCategory LIMIT 1;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':slugCategory', $slugCategory, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Categorie::class);
        // Fetch a single row as an object of the Categorie class
        $result = $stmt->fetch(PDO::FETCH_CLASS, PDO::FETCH_ORI_NEXT, 0);

        // Return the result or null if no row was found
        return $result !== false ? $result : null;
    }

    /**
     * @return array[Categorie]
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM categorie;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

}
