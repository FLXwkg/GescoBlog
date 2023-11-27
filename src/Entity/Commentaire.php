<?php
namespace App\Entity;

use DateTime;

class Commentaire
{
    /**
     * @var int
     */
    protected int $id_commentaire;

    /**
     * @var string
     */
    protected string $auteur_commentaire;

    /**
     * @var string
     */
    protected string $texte_commentaire;

    /**
     * @var string
     */
    protected string $date_commentaire;

    /**
     * @var string
     */
    protected string $date_modification_commentaire;

    /**
     * @var int
     */
    protected int $id_article;

    /**
     * @param int $id
     * @return Commentaire 
     */
    public function setId(int $id): Commentaire
    {
        $this->id_commentaire = $id;
        return $this;
    }
    
    /**
     * @return int 
     */
    public function getId(): int
    {
        return $this->id_commentaire;
    }

    /**
     * @param string $auteur
     * @return Commentaire 
     */
    public function setAuteur(string $auteur): Commentaire
    {
        $this->auteur_commentaire = $auteur;
        return $this;
    }

    /**
     * @return string 
     */
    public function getAuteur(): string
    {
        return $this->auteur_commentaire;
    }

    /**
     * @param string $texte
     * @return Commentaire 
     */
    public function setTexte(string $texte): Commentaire
    {
        $this->texte_commentaire = $texte;
        return $this;
    }

    /**
     * @return string 
     */
    public function getTexte(): string
    {
        return $this->texte_commentaire;
    }

    /**
     * @param string $date
     * @return Commentaire 
     */
    public function setDate(string $date): Commentaire
    {
        $this->date_commentaire = $date;
        return $this;
    }

    /**
     * @return DateTime 
     */
    public function getDate() : DateTime
    {
        return DateTime::createFromFormat('Y-m-d H:i:s',$this->date_commentaire);
    }

    /**
     * @param string $date
     * @return Commentaire 
     */
    public function setDateModif(string $date): Commentaire
    {
        $this->date_modification_commentaire = $date;
        return $this;
    }

    /**
     * @return DateTime 
     */
    public function getDateModif() : DateTime
    {
        return DateTime::createFromFormat('Y-m-d H:i:s',$this->date_modification_commentaire);
    }

    /**
     * @return int 
     */
    public function getIdArticle(): int
    {
        return $this->id_article;
    }

    /**
     * @return array 
     */
    public function toArray() : array
    {
        $date = $this->getDate();
        $dateModif = $this->getDateModif();
        return [
            'idCommentaire' => $this->getId(),
            'auteurCommentaire' => $this->getAuteur(),
            'texteCommentaire' => $this->getTexte(),
            'dateCommentaire' => $date->format('c'),
            'dateModificationCommentaire' => $dateModif->format('c'),
            'idArticle' => $this->getIdArticle()
        ];
    }
}