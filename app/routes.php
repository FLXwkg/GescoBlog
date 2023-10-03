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


    //Routes des différentes catégories

    $app->get('/home', function ($request, $response, $args) {
        $pdo = $this->get('db');

        $stmt = $pdo->query('SELECT * FROM article;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['article'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 14;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categorie'] = $categorie;

        if ($article) {
            $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article[0]['id_article'] . '";');
            $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $args['commentaire'] = $commentaire;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    });

    $app->get('/world', function ($request, $response, $args) {
        $pdo = $this->get('db');

        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 4;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['article'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 4;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categorie'] = $categorie;

        if ($article) {
            $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article[0]['id_article'] . '";');
            $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $args['commentaire'] = $commentaire;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    });

    $app->get('/technology', function ($request, $response, $args) {
        $pdo = $this->get('db');

        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 5;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['article'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 5;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categorie'] = $categorie;

        if ($article) {
            $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article[0]['id_article'] . '";');
            $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $args['commentaire'] = $commentaire;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    });

    $app->get('/design', function ($request, $response, $args) {
        $pdo = $this->get('db');

        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 6;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['article'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 6;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categorie'] = $categorie;

        if ($article) {
            $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article[0]['id_article'] . '";');
            $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $args['commentaire'] = $commentaire;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    });

    $app->get('/culture', function ($request, $response, $args) {
        $pdo = $this->get('db');

        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 7;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['article'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 7;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categorie'] = $categorie;

        if ($article) {
            $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article[0]['id_article'] . '";');
            $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $args['commentaire'] = $commentaire;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    });

    $app->get('/business', function ($request, $response, $args) {
        $pdo = $this->get('db');

        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 8;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['article'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 8;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categorie'] = $categorie;

        if ($article) {
            $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article[0]['id_article'] . '";');
            $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $args['commentaire'] = $commentaire;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    });

    $app->get('/politics', function ($request, $response, $args) {
        $pdo = $this->get('db');

        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 9;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['article'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 9;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categorie'] = $categorie;

        if ($article) {
            $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article[0]['id_article'] . '";');
            $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $args['commentaire'] = $commentaire;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    });

    $app->get('/science', function ($request, $response, $args) {
        $pdo = $this->get('db');

        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 10;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['article'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 10;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categorie'] = $categorie;

        if ($article) {
            $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article[0]['id_article'] . '";');
            $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $args['commentaire'] = $commentaire;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    });

    $app->get('/health', function ($request, $response, $args) {
        $pdo = $this->get('db');

        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 11;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['article'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 11;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categorie'] = $categorie;

        if ($article) {
            $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article[0]['id_article'] . '";');
            $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $args['commentaire'] = $commentaire;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    });

    $app->get('/style', function ($request, $response, $args) {
        $pdo = $this->get('db');

        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 12;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['article'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 12;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categorie'] = $categorie;

        if ($article) {
            $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article[0]['id_article'] . '";');
            $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $args['commentaire'] = $commentaire;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    });

    $app->get('/travel', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 13;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['article'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 13;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categorie'] = $categorie;

        if ($article) {
            $stmt3 = $pdo->query('SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article WHERE article.id_article = "' . $article[0]['id_article'] . '";');
            $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $args['commentaire'] = $commentaire;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    });
};
