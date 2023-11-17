<?php
namespace App\Entity;

use DateTime;

class Article
{
    /**
     * @var int
     */
    protected int $id_article;

    /**
     * @var string
     */
    protected string $titre_article;

    /**
     * @var string
     */
    protected string $texte_article;

    /**
     * @var string
     */
    protected string $date_article;

    /**
     * @var string
     */
    protected string $date_modification_article;

    /**
     * @var string
     */
    protected string $auteur_article;

    /**
     * @var int
     */
    protected int $id_categorie;

    /**
     * @var string
     */
    protected string $url_article;

    /**
     * @var string
     */
    protected string $slug;

    /**
     * @var string
     */
    protected string $nom_categorie;

    /**
     * @var int
     */
    protected int $nombre_commentaires;

    /**
     * @var string
     */
    protected string $categorie_slug;

    /**
     * @param int $id
     * @return Article 
     */
    public function setId(int $id): Article
    {
        $this->id_article = $id;
        return $this;
    }

    /**
     * @return int 
     */
    public function getId(): int
    {
        return $this->id_article;
    }

    /**
     * @param string $titre
     * @return Article 
     */
    public function setTitre(string $titre): Article
    {
        $this->titre_article = $titre;
        return $this;
    }

    /**
     * @return string 
     */
    public function getTitre(): string
    {
        return $this->titre_article;
    }

    /**
     * @param string $texte
     * @return Article 
     */
    public function setTexte(string $texte): Article
    {
        $this->texte_article = $texte;
        return $this;
    }

    /**
     * @return string 
     */
    public function getTexte(): string
    {
        return $this->texte_article;
    }

    /**
     * @param string $date
     * @return Article 
     */
    public function setDate(string $date): Article
    {
        $this->date_article = $date;
        return $this;
    }

    public function getDate() : DateTime
    {
        return DateTime::createFromFormat('Y-m-d H:i:s',$this->date_article);
    }

    /**
     * @param string $date
     * @return Article 
     */
    public function setDateModif(string $date): Article
    {
        $this->date_modification_article = $date;
        return $this;
    }

    /**
     * @return DateTime 
     */
    public function getDateModif() : DateTime
    {
        return DateTime::createFromFormat('Y-m-d H:i:s',$this->date_modification_article);
    }

    /**
     * @param string $auteur
     * @return Article 
     */
    public function setAuteur(string $auteur): Article
    {
        $this->auteur_article = $auteur;
        return $this;
    }

    /**
     * @return string 
     */
    public function getAuteur(): string
    {
        return $this->auteur_article;
    }
    /**
     * @param int $id
     * @return Article 
     */
    public function setIdCategorie(int $id): Article
    {
        $this->id_categorie = $id;
        return $this;
    }

    /**
     * @return int 
     */
    public function getIdCategorie(): int
    {
        return $this->id_categorie;
    }

    /**
     * @param string $url
     * @return Article 
     */
    public function setUrlArticle(string $url): Article
    {
        $this->yurl_article = $url;
        return $this;
    }

    /**
     * @return string 
     */
    public function getUrlArticle(): string
    {
        return $this->url_article;
    }

    /**
     * @param string $slug
     * @return Article 
     */
    public function setSlug(string $slug): Article
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string 
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string  $nom_categorie
     * @return Article
     */
    public function setNomCategorie($nom_categorie): Article
    {
        $this->nom_categorie = $nom_categorie;
        return $this;
    }

    /**
     * @return string 
     */
    public function getNomCategorie(): string
    {
        return $this->nom_categorie;
    }

    /**
     * @param int $nombre
     * @return Article 
     */
    public function setNombreCommentaires(int $nombre): Article
    {
        $this->nombre_commentaires = $nombre;
        return $this;
    }

    /**
     * @return int
     */
    public function getNombreCommentaires(): int
    {
        return $this->nombre_commentaires;
    }

    /**
     * @param string $slug
     * @return Article 
     */
    public function setSlugCategorie(string $slug): Article
    {
        $this->categorie_slug = $slug;
        return $this;
    }

    /**
     * @return string 
     */
    public function getSlugCategorie(): string
    {
        return $this->categorie_slug;
    }
}
