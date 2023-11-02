<?php

declare(strict_types=1);

use App\Configuration;
use App\Support\TemplateFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

use App\CategoriesRepository;
use App\Controller\GenericController;
use App\Controller\HomeController;
use App\Controller\ArticleController;
use App\Controller\CommentaireController;
use App\Controller\PostArticleController;


return function (App $app, Configuration $configuration) {


    /**
     * Page d'accueil
     */
    $app->get('/', function (Request $request, Response $response, $args) use ($configuration) {
        return (new HomeController($request, $response, $configuration))->handle($response);
    });


    /**
     * Les catégories principales
     */
    $app->get('/{categorie}', function (Request $request, Response $response, $args) use ($configuration) {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getIdByName($args['categorie']);
        if ($args['categorie'] === 'home') {
            return $response->withHeader('Location', "/")->withStatus(301);
        }
        return (new GenericController($request, $response, $configuration))->handle($response, $id[0]->getId());
    });

    /**
     * L'ajout d'articles
     */
    $app->post('/{categorie}', function (Request $request, Response $response, $args) use ($configuration) {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getIdByName($args['categorie']);
        $slugCategorie = $args['categorie'];

        return (new PostArticleController($request, $response, $configuration))->handle($request, $response, $slugCategorie, $id[0]->getId());
    });


    /**
     * Les articles
     */
    $app->get('/{categorie}/{slug_article}', function (Request $request, Response $response, $args) use ($configuration) {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getCatIdBySlugArticle($args['slug_article']);

        return (new ArticleController($request, $response, $configuration))->handle($response, $args['slug_article'], $id[0]->getId());
    });

    /**
     * L'ajout des commentaires
     */
    $app->post('/{categorie}/{slug_article}', function (Request $request, Response $response, $args) use ($configuration) {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getCatIdBySlugArticle($args['slug_article']);

        return (new CommentaireController($request, $response, $configuration))->handle($request, $response, $args['slug_article'], $id[0]->getId());
    });
};
