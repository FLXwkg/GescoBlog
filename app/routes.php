<?php

declare(strict_types=1);

use App\Configuration;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

use App\CategoriesRepository;
use App\GenericController;
use App\HomeController;
use App\ArticleController;
use App\CommentaireController;
use App\PostArticleController;


return function (App $app, Configuration $configuration) {


    /**
     * Page d'accueil
     */
    $app->get('/', function (Request $request, Response $response) {
        return (new HomeController())->handle($response);
    });


    /**
     * Les catégories principales
     */
    $app->get('/{categorie}', function ($request, $response, $args) {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getIdByName($args['categorie']);
        if ($args['categorie'] === 'home') {
            return $response->withHeader('Location', "/")->withStatus(301);
        }
        return (new GenericController())->handle($response, $id[0]->getId());
    });

    /**
     * L'ajout d'articles
     */
    $app->post('/{categorie}', function ($request, $response, $args) {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getIdByName($args['categorie']);
        $slugCategorie = $args['categorie'];

        return (new PostArticleController())->handle($request, $response, $slugCategorie, $id[0]->getId());
    });


    /**
     * Les articles
     */
    $app->get('/{categorie}/{slug_article}', function ($request, $response, $args) {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getCatIdBySlugArticle($args['slug_article']);
        
        return (new ArticleController())->handle($response, $args['slug_article'], $id[0]->getId());
    });

    /**
     * L'ajout des commentaires
     */
    $app->post('/{categorie}/{slug_article}', function ($request, $response, $args) {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getCatIdBySlugArticle($args['slug_article']);
        
        return (new CommentaireController())->handle($request, $response, $args['slug_article'], $id[0]->getId());
    });
};
