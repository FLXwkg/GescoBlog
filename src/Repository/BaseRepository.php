<?php
namespace App\Repository;

use PDO;

class BaseRepository
{

    /**
    * @var PDO
    */
    protected PDO $pdo;

    /**
     * @param PDO $pdo 
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * @param string $class
     * @param array $configuration 
     * @return Object 
     */
    public static function createRepository(string $class, array $configuration = []): Object
    {
        $pdo = new PDO('mysql:host=' . $configuration['host'] .';dbname='. $configuration['name'] .';charset=utf8', $configuration['login'], $configuration['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $instance = new $class($pdo);
        
        return $instance;
    }

    /**
     * @param string $string
     * @return string 
     */
    public function slugifyText(string $string) : string
    {
        // Remove special characters and spaces
        $string = preg_replace('/[\'"\[\]]/', '-', $string);
        // Convert spaces to hyphens
        $string = preg_replace('/\s+/', '-', $string);
        
        // Remove consecutive hyphens
        $string = preg_replace('/-+/', '-', $string);
        
        // Convert to lowercase
        $string = mb_strtolower($string, 'UTF-8');
        
        // Remove leading and trailing hyphens
        $string = trim($string, '-');
        
        return $string;
    }
}