<?php

declare(strict_types=1);

use App\Configuration;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

use App\Controller\HomeController;
use App\Controller\CategoryController;
use App\Controller\ArticleController;
use App\Controller\PostCommentaireController;
use App\Controller\PostArticleController;

return function (App $app, Configuration $configuration) {


    /**
     * Page d'accueil
     */
    $app->get('/', function (Request $request, Response $response, $args) use ($configuration) {
        return (new HomeController($request, $response, $configuration))->handle($request, $response);
    });

    /**
     * Les catégories principales
     */
    $app->get('/{categorie}', function (Request $request, Response $response, $args) use ($configuration) {
        return (new CategoryController($request, $response, $configuration))->handle($request, $response, $args);
    });

    /**
     * L'ajout d'articles
     */
    $app->post('/{categorie}', function (Request $request, Response $response, $args) use ($configuration) {
        return (new PostArticleController($request, $response, $configuration))->handle($request, $response, $args);
    });

    /**
     * Les articles
     */
    $app->get('/{categorie}/{slug_article}', function (Request $request, Response $response, $args) use ($configuration) {
        return (new ArticleController($request, $response, $configuration))->handle($request, $response, $args);
    });

    /**
     * L'ajout des commentaires
     */
    $app->post('/{categorie}/{slug_article}', function ($request, $response, $args) use ($configuration) {
        return (new PostCommentaireController($request, $response, $configuration))->handle($request, $response, $args);
    });
    
    /**
     * Traitement Ajax des commentaires d'un article
     */
    $app->get('/{categorie}/{slug_article}/commentaires', function (Request $request, Response $response, $args) use ($configuration) {
        return (new ArticleController($request, $response, $configuration))->handleJson($request, $response, $args);
    });
    
};
