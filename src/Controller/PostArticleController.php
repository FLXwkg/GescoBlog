<?php
namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostArticleController extends BaseController
{
    public function handle(Request $request, Response $response, array $arg)
    {
        $categoriesRepository = $this->getRepository(CategoriesRepository::class);
        $category = $categoriesRepository->findOneBySlug($arg['categorie']);
        $urlCategorie = ;

        $data = $request->getParsedBody();
        if ($data) {
            
            $titre = $data['titre_article'];
            $auteur = $data['auteur_article'];
            $contenu = $data['texte_article'];
        
            $this->setArticle($titre, $auteur, $contenu, $category->getId());
        }
        
        return $response->withHeader('Location', "/$arg['categorie']")->withStatus(301);
    }
    

    protected function setArticle(string $titre, string $auteur, string $contenu, int $idCategorie)
    {
        $article = $this->getRepository(ArticlesRepository::class);
        $article->setArticle($titre, $auteur, $contenu, $idCategorie);
    }
}
