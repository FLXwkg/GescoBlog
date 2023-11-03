<?php
namespace App\Repository;

use App\Entity\Commentaire;
use PDO;

class CommentairesRepository extends BaseRepository
{
    public function getByArticleId($idArticle)
    {
        $sql = 'SELECT * FROM commentaire WHERE id_article = :idArticle;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idArticle', $idArticle, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Commentaire::class);
    }

    public function getByManyArticlesIds(array $ids)
    {
        if(empty($ids)){
            return [];
        }
        $idsSql = implode(',', array_values($ids));
        $sql = "SELECT * FROM commentaire WHERE id_article IN(".$idsSql.");";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Commentaire::class);

    }

    public function setCommentaire(string $auteur, string $contenu, int $idArticle)
    {
        $date = date('Y-m-d h:i:s', time());
        $sql = 'INSERT INTO commentaire (auteur_commentaire, texte_commentaire, date_commentaire, date_modification_commentaire, id_article)
                VALUES (:auteur_commentaire, :texte_commentaire, :date_commentaire, :date_modification_commentaire, :idArticle);';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':auteur_commentaire', $auteur, PDO::PARAM_STR);
        $stmt->bindParam(':texte_commentaire', $contenu, PDO::PARAM_STR);
        $stmt->bindParam(':date_commentaire', $date, PDO::PARAM_STR);
        $stmt->bindParam(':date_modification_commentaire', $date, PDO::PARAM_STR);
        $stmt->bindParam(':idArticle', $idArticle, PDO::PARAM_INT);
        $stmt->execute();

    }
}