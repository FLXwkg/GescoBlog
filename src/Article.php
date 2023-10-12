<?php
namespace App;

class Article
{
    
    protected $id_article;
    protected $titre_article;
    protected $texte_article;
    protected $date_article;
    protected $date_modification_article;
    protected $auteur_article;
    protected $id_categorie;
    

    public function getId()
    {
        return $this->id_article;
    }

    public function getTitre()
    {
        return $this->titre_article;
    }
    public function getTexte()
    {
        return $this->texte_article;
    }

    public function getDate()
    {
        return $this->date_article;
    }

    public function getDateModif()
    {
        return $this->date_modification_article;
    }

    public function getAuteur()
    {
        return $this->auteur_article;
    }

    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

}
