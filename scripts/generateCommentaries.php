<?php
require __DIR__ . '/../vendor/autoload.php';

$host = 'dev.local';
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
    // Insertion de commentaires fictifs
    for ($i = 0; $i < 5; $i++) {

        $author = $faker->name;
        $text = $faker->realText($maxNbChars = 50);
        $date = $faker->date($format = 'Y-m-d', $max = 'now');
        $modifDate = $faker->date($format = 'Y-m-d', $min = $date);
        $ArtId = $faker->numberBetween($min = 1, $max = 13);

        $sql = "INSERT INTO commentaire (auteur_commentaire, texte_commentaire, date_commentaire, date_modification_commentaire, id_article) VALUES (:auteur_commentaire, :texte_commentaire, :date_commentaire, :date_modification_commentaire, :id_article);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':auteur_commentaire', $author);
        $stmt->bindParam(':texte_commentaire', $text);
        $stmt->bindParam(':date_commentaire', $date);
        $stmt->bindParam(':date_modification_commentaire', $modifDate);
        $stmt->bindParam(':id_article', $ArtId);
        $stmt->execute();
    }

    echo "Données Faker insérées avec succès dans la base de données.";
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}