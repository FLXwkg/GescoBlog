<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\RouteCategorie;
use App\GenericController;
use App\HomeController;
use App\ArticleController;

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

    $app->get('/{page}', function ($request, $response, $args) {
        $route = new RouteCategorie($args['page']);
        $id = $route->getRouteCategories();
        if($args['page']=== 'home'){
            $homeController = new HomeController();
            return $homeController->handleRoute($request, $response, $args, $id);
        }else{
            $genericController = new GenericController();
            return $genericController->handleRoute($request, $response, $args, $id);
        }
    });
    
    // Route dynamique pour afficher un article

    $app->get('/{page}/{titre_article}', function ($request, $response, $args) {
        $route = new RouteCategorie($args['page']);
        $titreArticle = $args['titre_article'];
        $id = $route->getCategorieViaTitreArticle($titreArticle);
        if($args['page']=== 'home'){
            $nomCategorie = $route->getCategorieViaId($id);
            return $response->withHeader('Location', "/$nomCategorie/$titreArticle")->withStatus(301);;
        }else{
            $articleController = new ArticleController();
            return $articleController->render($request, $response, $args, $titreArticle, $id);
        }
    });
};
