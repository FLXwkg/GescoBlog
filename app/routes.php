<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Views\PhpRenderer;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello Blog!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

///////////////////////
//Routes des différentes catégories

    $app->get('/home', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article;');
        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 14;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['article'] = $article;
        $args['categorie'] = $categorie;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/world', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 4;');
        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 4;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        
        //var_dump($article);die();

        $article_id = $article['id_article'];

        $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article_id .'";');
        $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        

        $renderer = new PhpRenderer('../templates');
        $args['article'] = $article;
        $args['categorie'] = $categorie;
        $args['commentaires'] = $commentaire;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/technology', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 5;');
        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 5;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['article'] = $article;
        $args['categorie'] = $categorie;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/design', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 6;');
        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 6;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['article'] = $article;
        $args['categorie'] = $categorie;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/culture', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 7;');
        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 7;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['article'] = $article;
        $args['categorie'] = $categorie;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/business', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 8;');
        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 8;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['article'] = $article;
        $args['categorie'] = $categorie;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/politics', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 9;');
        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 9;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['article'] = $article;
        $args['categorie'] = $categorie;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/science', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 10;');
        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 10;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['article'] = $article;
        $args['categorie'] = $categorie;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/health', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 11;');
        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 11;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['article'] = $article;
        $args['categorie'] = $categorie;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/style', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 12;');
        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 12;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['article'] = $article;
        $args['categorie'] = $categorie;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/travel', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 13;');
        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 13;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['article'] = $article;
        $args['categorie'] = $categorie;

        return $renderer->render($response, "view.html", $args);
    });
};
