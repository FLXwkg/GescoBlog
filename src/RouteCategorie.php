<?php
namespace App;

use PDO;
use App\PDOConfiguration;

class RouteCategorie
{
    protected $idCategorie;
    protected $nom;
    
    public function __construct(string $routeCategorie)
    {
        $this->setRouteCategories($routeCategorie);
    }

    public function setRouteCategories(string $routeCategorie): RouteCategorie
    {
        $this->nom = $routeCategorie;
        //var_dump($this->nom);die();
        $config = new PDOConfiguration(require __DIR__.'/../config/application.config.php');
        $pdo = $config->getPDO();
        $sql = "SELECT id_categorie FROM categorie WHERE nom_categorie = '". $this->nom ."';";
        $requete = $pdo->query($sql);
        $this->idCategorie = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $this;
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