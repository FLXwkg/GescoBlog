<?php
namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class PostArticleController
{
    public function handle(Request $request, Response $response, string $urlCategorie, int $idCategorie)
    {
        $data = $request->getParsedBody();
        if ($data) {
            
            $titre = $data['titre_article'];
            $auteur = $data['auteur_article'];
            $contenu = $data['texte_article'];
            //var_dump($data);die();
        
            $this->setArticle($titre, $auteur, $contenu, $idCategorie);
        }
        
        $renderer = new PhpRenderer('../templates');
        return $response->withHeader('Location', "/$urlCategorie")->withStatus(301);
    }
    

    protected function setArticle(string $titre, string $auteur, string $contenu, int $idCategorie)
    {
        $article = new ArticlesRepository();
        $article->setArticle($titre, $auteur, $contenu, $idCategorie);
    }
}
