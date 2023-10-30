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
    $app->get('/{categorie}', function ($request, $response, $args) {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getIdByName($args['categorie']);
        if ($args['categorie'] === 'home') {
            return $response->withHeader('Location', "/")->withStatus(301);
        }
        return (new GenericController())->handle($response, $id[0]->getId());
    });


    /**
     * Les pages
     */
    $app->get('/{categorie}/{slug_article}', function ($request, $response, $args) {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getCatIdBySlugArticle($args['slug_article']);
        
        return (new ArticleController())->handle($response, $args['slug_article'], $id[0]->getId());
    });

    $app->post('/{categorie}/{slug_article}/addCommentary', function ($request, $response, $args){
        $auteurCommentaire = $_POST['auteur_commentaire'];
        $texteCommentaire = $_POST['texte_commentaire'];
        $url = $args['categorie'] . '/' . $args['slug_article'];
        $articlesRepository = new ArticlesRepository();
        $idArticle = $articlesRepository->getIdBySlugArticle($args['slug_article']);
        $commentairesRepository = new CommentairesRepository();
        $commentairesRepository->setCommentary($auteurCommentaire, $texteCommentaire, $idArticle);

        return $response->withHeader('Location', "/$url")->withStatus(301);
    });
};
