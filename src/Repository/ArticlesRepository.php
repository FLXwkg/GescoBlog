<?php

namespace App\Repository;

use App\Entity\Article;
use PDO;

class ArticlesRepository extends BaseRepository
{

    /**
     * @param int $categoryId
     * @return array[Article] 
     */
    public function getByCategory(int $categoryId)
    {

        $start = $this->getNumberQueryStart();
        $end = $this->getNumberQueryEnd();
        $sql = $start . " WHERE a.id_categorie = :categoryId " . $end;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    /**
     * @return string  
     */
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

    /**
     * @return string
     */
    protected function getNumberQueryEnd(): string
    {
        return <<<SQL
                    GROUP BY a.id_article, ca.nom_categorie, a.slug, ca.slug
                    ORDER BY a.date_article DESC;
                SQL;
    }

    /**
     * @return string
     */
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

    /**
     * @return array[Article] 
     */
    public function getAll(): array
    {
        $start = $this->getNumberQueryStart();
        $end = $this->getNumberQueryEnd();
        $sql = $start . $end;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    /**
     * @param array $params
     * @return Article|null
     * @throws \Exception
     */
    public function findOneBy(array $params):?Article
    {
        $base = $this->getNumberQueryStart();
        $sql = $base . " WHERE 1";
        if(0 === count($params)){
            throw new \Exception('At least 1 parameter needed');
        }
        foreach ($params as $key => $value){
            $sql.= ' AND a.'.$key.' = :'.$key;
        }
        $sql.= ' GROUP BY a.id_article LIMIT 0,1';
        $stmt = $this->pdo->prepare($sql);
        $queryParams = [];
        foreach ($params as $key => $value){
            $queryParams[':'.$key] = $value;
        }
        $stmt->execute($queryParams);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Article::class);
        $result = $stmt->fetch();
        return $result instanceof Article ? $result : null;
    }

    /**
     * @param string $titre
     * @param string $auteur
     * @param string $contenu
     * @param int $idCategorie 
     */
    public function setArticle(string $titre, string $auteur, string $contenu, int $idCategorie)
    {
        $date = date('Y-m-d h:i:s', time());
        $slug = $this->slugifyText($titre);
        $sql = 'INSERT INTO article (titre_article, slug, texte_article, date_article, date_modification_article, auteur_article, id_categorie)
                VALUES (:titre_article, :slug, :texte_article, :date_article, :date_modification_article, :auteur_article, :id_categorie);';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':titre_article', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->bindParam(':texte_article', $contenu, PDO::PARAM_STR);
        $stmt->bindParam(':date_article', $date, PDO::PARAM_STR);
        $stmt->bindParam(':date_modification_article', $date, PDO::PARAM_STR);
        $stmt->bindParam(':auteur_article', $auteur, PDO::PARAM_STR);
        $stmt->bindParam(':id_categorie', $idCategorie, PDO::PARAM_INT);
        $stmt->execute();
    }
}