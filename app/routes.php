<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

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
        /*$pdo = $this->get('db');

        $stmt = $pdo->query('SELECT * FROM article;');
        $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $args['articles'] = $article;

        $stmt2 = $pdo->query('SELECT nom_categorie FROM categorie WHERE id_categorie = 14;');
        $categorie = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $args['categories'] = $categorie;

        if ($article) {
            $commentaires = [];
            if(count($article)> 0){
                for($i=0;$i<count($article);$i++){
                    $stmt3 = $pdo->query('SELECT * FROM commentaire WHERE id_article = ' . $article[$i]['id_article'] . ';');
                    $commentaire = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                    $commentaires = array_merge($commentaires,$commentaire);
                }
            }
            $args['commentaires'] = $commentaires;
        }*/

        //comment récuperer tous les articles? extend de article

        $homeController = new HomeController();
        return $homeController->handleRoute($request, $response, $args, 14);
    });

    /*$app->get('/world', function ($request, $response, $args) {
        $id = 4;
        $categorie = new Categorie($id);
        $nomCategorie = $categorie->getCategories();
        $args['categories'] = $nomCategorie;
        
        $article = new Article($id);
        $contentArticle = $article->getArticles();
        $args['articles'] = $contentArticle;
        

        if ($contentArticle) {
            $commentairesPage = [];
            if(count($contentArticle)> 0){
                for($i=0;$i<count($contentArticle);$i++){
                    $commentaire = new Commentaire($article,$i);
                    $commentairesArticle = $commentaire->getCommentaires();
                    $commentairesPage = array_merge($commentairesPage,$commentairesArticle);
                }
            }
            $args['commentaires'] = $commentairesPage;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
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
};
