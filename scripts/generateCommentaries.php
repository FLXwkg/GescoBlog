<?php

use App\PDOConfiguration;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/application.config.php';

try {
    $config = new PDOConfiguration(require __DIR__ . '/../config/application.config.php');
    $pdo = $config->getPDO();

    // Appel de Faker pour générer des données
    $faker = Faker\Factory::create('fr_FR');


    // preparation de la requete
    $stmt = $pdo->prepare("INSERT INTO 
                    commentaire (auteur_commentaire, texte_commentaire, date_commentaire, date_modification_commentaire, id_article) 
                    VALUES (:auteur_commentaire, :texte_commentaire, :date_commentaire, :date_modification_commentaire, :id_article);");
    // boucle pour generation d'articles aleatoires
    for ($i = 0; $i < 10; $i++) {
        $date = $faker->date($format = 'Y-m-d', $max = 'now');

        $stmt->execute([
            ':auteur_commentaire' => $faker->realTextBetween(25, 45),
            ':texte_commentaire' => $faker->realText($maxNbChars = 200),
            ':date_commentaire' => $date,
            ':date_modification_commentaire' => $faker->date($format = 'Y-m-d', $max = $date),
            ':id_article' => $faker->numberBetween($min = 3, $max = 23),
        ]);
    }

    echo "Données Faker insérées avec succès dans la base de données." . PHP_EOL;
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}