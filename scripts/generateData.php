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


    // Insertion d'articles fictifs
    for ($i = 0; $i < 10; $i++) {
        /*$titre = $faker->name;
        $text = $faker->paragraph($nbSentences = 3, $variableNbSentences = true);
        $date = $faker->date($format = 'Y-m-d', $max = 'now');
        $modifDate = $faker->date($format = 'Y-m-d', $max < $date);
        $author = $faker->name($gender = 'male'|'female');
        $catId = $faker->numberBetween($min = 4, $max = 13);*/

        $titre = $faker->name;
        $text = $faker->realText($maxNbChars = 200);
        $date = $faker->date($format = 'Y-m-d', $max = 'now');
        $modifDate = $faker->date($format = 'Y-m-d', $max = $date);
        $author = $faker->name($gender = 'male' | 'female');
        $catId = $faker->numberBetween($min = 4, $max = 13);

        $sql = "INSERT INTO article 
                    (titre_article, texte_article, date_article, date_modification_article, auteur_article, id_categorie) 
                VALUES 
                    (:titre_article, :texte_article, :date_article, :date_modification_article, :auteur_article, :id_categorie);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titre_article', $titre);
        $stmt->bindParam(':texte_article', $text);
        $stmt->bindParam(':date_article', $date);
        $stmt->bindParam(':date_modification_article', $modifDate);
        $stmt->bindParam(':auteur_article', $author);
        $stmt->bindParam(':id_categorie', $catId);
        $stmt->execute();
    }

    echo "Données Faker insérées avec succès dans la base de données.";
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
