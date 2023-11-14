<?php
namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CommentairesRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class CommentaireController extends BaseController
{
    public function handle(Request $request, Response $response, $arg)
    {
        $articles = $this->getRepository(ArticlesRepository::class);
        $contentArticle = $articles->getBySlug($arg['slug_article']);
        
        $idArticle = $contentArticle[0]->getId();
        $urlArticle = $contentArticle[0]->getUrlArticle();

        $data = $request->getParsedBody();
        if ($data) {
            
            $auteur = $data['auteur_commentaire'];
            $contenu = $data['texte_commentaire'];
        
            $this->setCommentaire($auteur, $contenu, $idArticle);
        }
        
        return $response->withHeader('Location', "/$urlArticle")->withStatus(301);
    }

    protected function setCommentaire(string $auteur, string $contenu, int $idArticle)
    {
        $commentaire = $this->getRepository(CommentairesRepository::class);
        $commentaire->setCommentaire($auteur, $contenu, $idArticle);
    }
}
