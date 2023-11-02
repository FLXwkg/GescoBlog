<?php
namespace App\Controller;

use App\ArticlesRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class PostArticleController extends BaseController
{
    public function handle(Request $request, Response $response, string $urlCategorie, int $idCategorie)
    {
        $data = $request->getParsedBody();
        if ($data) {
            
            $titre = $data['titre_article'];
            $auteur = $data['auteur_article'];
            $contenu = $data['texte_article'];
        
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
