<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/dependencies.php';

// Instanciation du conteneur de dépendances Slim
$containerBuilder = new DI\ContainerBuilder();
$container = $containerBuilder->build();

// Récupération la connexion à la base de données depuis le conteneur
$pdo = $container->get('db');

// Appel de Faker pour générer des données
$faker = Faker\Factory::create();

try {
    // Supprimer toutes les entrées de la table article
    $deleteQuery = "TRUNCATE TABLE article";
    $pdo->exec($deleteQuery);

    // Insertion d'articles fictifs
    for ($i = 0; $i < 1; $i++) {
        $titre = $faker->name;
        $text = $faker->realText($maxNbChars = 200);
        $date = $faker->date($format = 'Y-m-d', $max = 'now');
        $modifDate = $faker->date($format = 'Y-m-d', $max < $date);
        $author = $faker->name($gender = null|'male'|'female');
        $catId = $faker->numberBetween($min = 4, $max = 13);

        $sql = "INSERT INTO article (titre_article, texte_article, date_article, date_modification_article, auteur_article, id_categorie) VALUES (:titre_article, :texte_article, :date_article, :date_modification_article, :auteur_article, :id_categorie)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titre_article', $titre);
        $stmt->bindParam(':texte_article', $text);
        $stmt->bindParam(':date_article', $date);
        $stmt->bindParam(':date_modification_article', $modifDate)
        ;$stmt->bindParam(':auteur_article', $author);
        $stmt->bindParam(':id_categorie', $catId);
        $stmt->execute();
    }

    echo "Données Faker insérées avec succès dans la base de données.";
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}