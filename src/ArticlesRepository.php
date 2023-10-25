<?php

namespace App;

use App\Article;
use PDO;


class ArticlesRepository extends CategoriesRepository
{

    public function getByCategory(int $categoryId)
    {
        $pdo = $this->getPDO();
        $base = $this->getBaseQuery();
        $sql = $base . " WHERE t1.id_categorie = :categoryId;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    protected function getBaseQuery($alias = 't1'): string
    {
        $selector = empty($alias) ? '*' : $alias . '.*';
        return <<<SQL
                    SELECT 
                    CONCAT_WS("/", t2.slug, $alias.slug) as url_article, 
                    t2.nom_categorie,
                    $selector
                    FROM article $alias
                    left join categorie t2
                    on $alias.id_categorie = t2.id_categorie
                SQL;

    }

    public function getAll()
    {
        $pdo = $this->getPDO();
        $sql = $this->getBaseQuery();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function getBySlug(string $slugArticle)
    {
        $pdo = $this->getPDO();
        $base = $this->getBaseQuery();
        $sql = $base . " WHERE t1.slug = :slugArticle;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':slugArticle', $slugArticle, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }
}