<?php
namespace App;

use PDO;
use App\PDOConfiguration;

class Categorie
{
    protected $id_categorie;
    protected $nom_categorie;
    protected $slug;

    public function getId()
    {
        return $this->id_categorie;
    }

    public function getNom()
    {
        return $this->nom_categorie;
    }

    public function getSlug()
    {
        return $this->slug;
    }
}