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

    $homeCategory = 14;


    /**
     * Page d'accueil
     */
    $app->get('/', function (Request $request, Response $response) use ($homeCategory) {
        $homeController = new HomeController();
        return $homeController->handleRoute($request, $response, ['page' => 'home'], $homeCategory);
    });


    /**
     * Les catégories principales
     */
    $app->get('/{page}', function ($request, $response, $args) {
        $route = new CategoriesRepository();
        $id = $route->getIdByName($args['page']);
        if ($args['page'] === 'home') {
            return $response->withHeader('Location', "/")->withStatus(301);
        }
        $genericController = new GenericController();
        return $genericController->handleRoute($request, $response, $args, $id[0]->getId());
    });

    // Route dynamique pour afficher un article

    $app->get('/{page}/{titre_article}', function ($request, $response, $args) {
        $route = new CategoriesRepository();
        $titreArticleSlug = $args['titre_article'];
        $titreArticle = unslugifyText($args['titre_article']);
        $id = $route->getIdByArticle($titreArticle);
        $Categorie = $route->getNameById($id[0]->getId());
        $nomCategorie = strtolower($Categorie[0]->getNom());
        //var_dump("/$nomCategorie/$titreArticleSlug");die();
        if ($args['page'] === 'home') {
            return $response->withHeader('Location', "/$nomCategorie/$titreArticleSlug")->withStatus(301);
        } else {
            $articleController = new ArticleController();
            return $articleController->render($request, $response, $args, $titreArticle, $id[0]->getId());
        }
    });
};
