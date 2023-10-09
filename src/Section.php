<?php
namespace App;

use PDO;
use App\PDOConfiguration;

class Section
{
    protected $sections = [];
    
    public function __construct()
    {
        $this->setSections();
    }

    public function setSections(): Section
    {
        $config = new PDOConfiguration(require __DIR__.'/../config/application.config.php');
        $pdo = $config->getPDO();
        $sql = 'SELECT * FROM categorie;';
        $requete = $pdo->query($sql);
        $this->sections = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $this;
    }

    public function getSections(): array
    {
        return $this->sections;
    }
}