<?php
require __DIR__ . '/../vendor/autoload.php';

$host = 'localhost';
$dbname = 'homestead';
$username = 'homestead';
$password = 'secret';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Appel de Faker pour générer des données
$faker = Faker\Factory::create('fr_FR');

try {
    // preparation de la requete
    $stmt = $pdo->prepare("INSERT INTO article 
                    (titre_article, texte_article, date_article, date_modification_article, auteur_article, id_categorie) 
                VALUES 
                    (:titre_article, :texte_article, :date_article, :date_modification_article, :auteur_article, :id_categorie);");


    // boucle pour generation d'articles aleatoires
    for ($i = 0; $i < 10; $i++) {

        $date = $faker->date($format = 'Y-m-d', $max = 'now');

        $stmt->execute([
            ':titre_article' => $faker->realTextBetween(25, 45),
            ':texte_article' => $faker->realText($maxNbChars = 200),
            ':date_article' => $date,
            ':date_modification_article' => $faker->date($format = 'Y-m-d', $max = $date),
            ':auteur_article' => $faker->name($gender = 'male' | 'female'),
            ':id_categorie' => $faker->numberBetween($min = 4, $max = 13),
        ]);
    }

    echo "Données Faker insérées avec succès dans la base de données." . PHP_EOL;
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
