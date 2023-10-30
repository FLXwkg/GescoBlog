<?php

namespace App;

use App\Article;
use PDO;


class ArticlesRepository extends CategoriesRepository
{

    public function getByCategory(int $categoryId)
    {
        $pdo = $this->getPDO();
        $start = $this->getNumberQueryStart();
        $end = $this->getNumberQueryEnd();
        $sql = $start . " WHERE a.id_categorie = :categoryId " . $end;
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    protected function getNumberQueryStart(): string
    {
        return <<<SQL
                    SELECT 
                        CONCAT_WS("/", ca.slug, a.slug) as url_article, 
                        ca.nom_categorie,
                        ca.slug as categorie_slug,
                        a.*,
                        COALESCE(COUNT(c.id_commentaire), 0) AS nombre_commentaires
                    FROM article a
                    LEFT JOIN categorie ca ON a.id_categorie = ca.id_categorie
                    LEFT JOIN commentaire c ON a.id_article = c.id_article
                SQL;
    }

    protected function getNumberQueryEnd(): string
    {
        return <<<SQL
                    GROUP BY a.id_article, ca.nom_categorie, a.slug, ca.slug
                    ORDER BY a.date_article DESC;
                SQL;
    }

    protected function getBaseQuery(): string
    {  
        return <<<SQL
                    SELECT 
                    CONCAT_WS("/", ca.slug, a.slug) as url_article, 
                    ca.nom_categorie,
                    a.*
                    FROM article a
                    left join categorie ca
                    on a.id_categorie = ca.id_categorie
                SQL;
    }

    public function getAll()
    {
        $pdo = $this->getPDO();
        $start = $this->getNumberQueryStart();
        $end = $this->getNumberQueryEnd();
        $sql = $start . $end;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function getBySlug(string $slugArticle)
    {
        $pdo = $this->getPDO();
        $base = $this->getBaseQuery();
        $sql = $base . " WHERE a.slug = :slugArticle;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':slugArticle', $slugArticle, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }
}