<?php
namespace App\Repository;

use App\PDOConfiguration;

class BaseRepository{
    public function getPDO()
    {
        $config = new PDOConfiguration(require __DIR__.'/../../config/application.config.php');
        $pdo = $config->getPDO();

        return $pdo;
    }
}