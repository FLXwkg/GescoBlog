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

    $app->get('/home', function ($request, $response, $args) {
        $pdo = $this->get('db');
        $stmt = $pdo->query('SELECT * FROM article');
        $dataFromDatabase = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $renderer = new PhpRenderer('../templates');
        $args['dataFromDatabase'] = $dataFromDatabase;

        return $renderer->render($response, "view.html", $args);
    });
    

    $app->get('/categories', function (Request $request, Response $response) {
        $pdo = $this->get('db'); // Récupérez l'objet PDO à partir du conteneur
    
        // Utilisez PDO pour récupérer des données depuis la base de données
        $stmt = $pdo->query('SELECT nom_categorie FROM categorie');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Retournez les données dans la réponse Slim
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    });
};
