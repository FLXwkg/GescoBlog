<?php
namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class CommentaireController
{
    public function handle(Request $request, Response $response, $slugArticle, $id)
    {
        $articles = new ArticlesRepository();
        $contentArticle = $articles->getBySlug($slugArticle);
        
        $idArticle = $contentArticle[0]->getId();
        $urlArticle = $contentArticle[0]->getUrlArticle();

        $data = $request->getParsedBody();
        if ($data) {
            
            $auteur = $data['auteur_commentaire'];
            $contenu = $data['texte_commentaire'];
            //var_dump($data);die();
        
            $this->setCommentaire($auteur, $contenu, $idArticle);
        }
        
        $renderer = new PhpRenderer('../templates');
        return $response->withHeader('Location', "/$urlArticle")->withStatus(301);
    }
    
    protected function getCommentaires(int $idArticle): array
    {
        $commentaire = new CommentairesRepository();
        return $commentaire->getByArticleId($idArticle);
    }

    protected function setCommentaire(string $auteur, string $contenu, int $idArticle)
    {
        $commentaire = new CommentairesRepository();
        $commentaire->setCommentaire($auteur, $contenu, $idArticle);
    }
}
