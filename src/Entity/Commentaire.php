<?php
namespace App\Entity;

use DateTime;

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

    public function getDate() : DateTime
    {
        return DateTime::createFromFormat('Y-m-d H:i:s',$this->date_commentaire);
    }

    public function getDateModif() : DateTime
    {
        return DateTime::createFromFormat('Y-m-d H:i:s',$this->date_modification_commentaire);
    }

    public function getIdArticle()
    {
        return $this->id_article;
    }

    public function toArray()
    {
        return [

        ];
    }
}