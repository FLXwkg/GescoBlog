<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Views\PhpRenderer;

use App\GenericController;
use App\HomeController;

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
        $homeController = new HomeController();
        return $homeController->handleRoute($request, $response, $args, 14);
    });

    /*$app->get('/{categorie}', function ($request, $response, $args) {
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, 4);
    });*/
    
    $app->get('/world', function ($request, $response, $args) {
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, 4);
    });
    
    $app->get('/technology', function ($request, $response, $args) {
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, 5);
    });

    $app->get('/design', function ($request, $response, $args) {
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, 6);
    });

    $app->get('/culture', function ($request, $response, $args) {
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, 7);
    });

    $app->get('/business', function ($request, $response, $args) {
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, 8);
    });

    $app->get('/politics', function ($request, $response, $args) {
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, 9);
    });

    $app->get('/science', function ($request, $response, $args) {
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, 10);
    });

    $app->get('/health', function ($request, $response, $args) {
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, 11);
    });

    $app->get('/style', function ($request, $response, $args) {
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, 12);
    });

    $app->get('/travel', function ($request, $response, $args) {
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, 13);
    });

    // Route dynamique pour afficher un article

    $app->get('/{categorie}/{titre_article}', function ($request, $response, $args) {
        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, 'viewArticle.php',$args);
    });
};
