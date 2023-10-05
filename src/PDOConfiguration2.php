<?php
namespace App;

class PDOConfiguration2
{
    protected $configuration = [];
    protected $pdo;
    
    public function __construct(array $configuration = [])
    {
        $this->setConfiguration($configuration);
    }

    public function setConfiguration(array $configuration): PDOConfiguration2
    {
        $this->configuration = $configuration;

        try {
            $this->pdo = new PDO('mysql:host=' . $configuration['host'] .';dbname='. $configuration['name'] .';charset=utf8', $configuration['login'], $configuration['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }

        return $this;
    }

    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    public function getPDO()
    {
        return $this->pdo;
    }
};
?>