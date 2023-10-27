<?php

namespace App;

use DateTime;

class Article
{

    protected $id_article;
    protected $titre_article;
    protected $texte_article;
    protected $date_article;
    protected $date_modification_article;
    protected $auteur_article;
    protected $id_categorie;

    protected $url_article;
    protected $slug;

    protected $nom_categorie;
    protected $nombre_commentaires;


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

    public function getDate() : DateTime
    {
        return DateTime::createFromFormat('Y-m-d H:i:s',$this->date_article);
    }

    public function getDateModif() : DateTime
    {
        //var_dump($this->date_modification_article);
        return DateTime::createFromFormat('Y-m-d H:i:s',$this->date_modification_article);
    }

    public function getAuteur()
    {
        return $this->auteur_article;
    }

    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    /**
     * @return mixed
     */
    public function getUrlArticle()
    {
        return $this->url_article;
    }

    /**
     * @param mixed $url_article
     * @return Article
     */
    public function setUrlArticle($url_article)
    {
        $this->url_article = $url_article;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return Article
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomCategorie()
    {
        return $this->nom_categorie;
    }

    /**
     * @param mixed $nom_categorie
     * @return Article
     */
    public function setNomCategorie($nom_categorie)
    {
        $this->nom_categorie = $nom_categorie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombreCommentaires()
    {
        return $this->nombre_commentaires;
    }
}
