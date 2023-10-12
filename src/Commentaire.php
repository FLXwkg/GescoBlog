<?php
namespace App;

use PDO;
use App\PDOConfiguration;

class Commentaire
{
    
    protected $id_commentaire;
    protected $auteur_commentaire;
    protected $texte_commentaire;
    protected $date_commentaire;
    protected $date_modification_commentaire;
    protected $id_article;
    

    public function getId()
    {
        return $this->id_commentaire;
    }

    public function getAuteur()
    {
        return $this->auteur_commentaire;
    }

    public function getTexte()
    {
        return $this->texte_commentaire;
    }

    public function getDate()
    {
        return $this->date_commentaire;
    }

    public function getDateModif()
    {
        return $this->date_modification_commentaire;
    }

    public function getIdArticle()
    {
        return $this->id_article;
    }
}