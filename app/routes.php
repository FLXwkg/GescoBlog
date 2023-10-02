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
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/world', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 4;');
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/technology', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 5;');
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/design', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 6;');
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/culture', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 7;');
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/business', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 8;');
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/politics', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 9;');
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/science', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 10;');
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/health', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 11;');
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/style', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 12;');
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });

    $app->get('/travel', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article WHERE id_categorie = 13;');
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });
};
