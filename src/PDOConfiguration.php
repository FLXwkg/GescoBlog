<?php
namespace App;

use PDO;

class PDOConfiguration
{
    protected $configuration = [];
    protected $pdo;
    
    public function __construct(array $configuration = [])
    {
        $this->setConfiguration($configuration);
    }

    public function setConfiguration(array $configuration): PDOConfiguration
    {
        $this->configuration = $configuration;
        $this->pdo = new PDO('mysql:host=' . $configuration['host'] .';dbname='. $configuration['name'] .';charset=utf8', $configuration['login'], $configuration['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
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
}