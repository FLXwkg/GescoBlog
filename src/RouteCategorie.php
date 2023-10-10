<?php
namespace App;

use PDO;
use App\PDOConfiguration;

class RouteCategorie
{
    protected $idCategorie;
    protected $nom;

    protected $titreArticle;
    
    public function __construct(string $routeCategorie)
    {
        $this->setRouteCategories($routeCategorie);
    }

    public function setRouteCategories(string $routeCategorie): RouteCategorie
    {
        $this->nom = $routeCategorie;
        $config = new PDOConfiguration(require __DIR__.'/../config/application.config.php');
        $pdo = $config->getPDO();
        $sql = "SELECT id_categorie FROM categorie WHERE nom_categorie = '". $this->nom ."';";
        $requete = $pdo->query($sql);
        $this->idCategorie = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $this;
    }

    public function getCategorieViaTitreArticle($titre): int
    {
        $this->titreArticle = $titre;
        $config = new PDOConfiguration(require __DIR__.'/../config/application.config.php');
        $pdo = $config->getPDO();
        $sql = "SELECT id_categorie FROM article WHERE titre_article = '" . $this->titreArticle ."';";
        $requete = $pdo->query($sql);
        $this->idCategorie = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $this->idCategorie[0]["id_categorie"];
    }

    public function getCategorieViaId($idCategorie) : string
    {
        $this->idCategorie = $idCategorie;
        $config = new PDOConfiguration(require __DIR__.'/../config/application.config.php');
        $pdo = $config->getPDO();
        $sql = "SELECT nom_categorie FROM categorie WHERE id_categorie = '" . $this->idCategorie . "';";
        $requete = $pdo->query($sql);
        $this->nom = $requete->fetchAll(PDO::FETCH_ASSOC);
        
        return $this->nom[0]['nom_categorie'];
    }

    

    public function getRouteCategories(): int
    {
        return (int)$this->idCategorie[0]['id_categorie'];
    }

    public function getNom()
    {
        return $this->nom;
    }
}