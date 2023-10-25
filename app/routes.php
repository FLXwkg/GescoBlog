<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

use App\CategoriesRepository;
use App\GenericController;
use App\HomeController;
use App\ArticleController;

require __DIR__ . "/../scripts/unslugifyText.php";

return function (App $app) {


    /**
     * Page d'accueil
     */
    $app->get('/', function (Request $request, Response $response) {
        return (new HomeController())->handle($response);
    });


    /**
     * Les catégories principales
     */
    $app->get('/{page}', function ($request, $response, $args) {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getIdByName($args['page']);
        if ($args['page'] === 'home') {
            return $response->withHeader('Location', "/")->withStatus(301);
        }
        $genericController = new GenericController();
        return $genericController->handle($response, $id[0]->getId());
    });


    /**
     * Les pages
     */
    $app->get('/{categorie}/{slug_article}', function ($request, $response, $args) {
        $route = new CategoriesRepository();
        $slugArticle = $args['slug_article'];
        $id = $route->getCatIdBySlugArticle($slugArticle);
        $Categorie = $route->getCatSlugByCatId($id[0]->getId());
        
        
        if ($args['categorie'] === 'home') {
            return $response->withHeader('Location', "/$Categorie/$slugArticle")->withStatus(301);
        } else {
            $articleController = new ArticleController();
            return $articleController->handle($response, $slugArticle, $id[0]->getId());
        }
    });
};
