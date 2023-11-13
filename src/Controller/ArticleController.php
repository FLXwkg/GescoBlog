<?php
namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;
use Slim\Views\PhpRenderer;

class ArticleController extends BaseController
{
    public function handle($response, $arg)
    {
        $categoriesRepository = $this->getRepository(CategoriesRepository::class);
        $id = $categoriesRepository->getCatIdBySlugArticle($arg['slug_article'])[0]->getId();
        $slugArticle = $arg['slug_article'];
        $args = [];
        $args['categories'] = $categoriesRepository->GetByCatId($id);
        $args['sections'] = $categoriesRepository->GetAll();

        $articles = $this->getRepository(ArticlesRepository::class);
        $contentArticle = $articles->getBySlug($slugArticle);
        $args['articles'] = $contentArticle;
        
        return $this->getRenderedResponse($args, 'viewArticle.php');
    }
    
    protected function getCommentaires(int $idArticle): array
    {
        $commentaire = $this->getRepository(CommentairesRepository::class);
        return $commentaire->getByArticleId($idArticle);
    }
    
    public function handleJson($response, $args)
    {
        try {
            $articles = $this->getRepository(ArticlesRepository::class);
            $idArticle = $articles->getBySlug($args['slug_article'])[0]->getId();
            $commentaires = $this->getCommentaires($idArticle);

            $array = [];
            foreach ($commentaires as $commentaire) {
                $date = $commentaire->getDate();
                $dateModif = $commentaire->getDateModif();
                $array[] = (object) [
                    'idCommentaire' => $commentaire->getId(),
                    'auteurCommentaire' => $commentaire->getAuteur(),
                    'texteCommentaire' => $commentaire->getTexte(),
                    'dateCommentaire' => $date->format('c'),
                    'dateModificationCommentaire' => $dateModif->format('c'),
                    'idArticle' => $commentaire->getIdArticle()
                ];
            }

            $commentairesJson = json_encode($array);

            if ($commentairesJson === false) {
                throw new \RuntimeException('JSON encoding error');
            }

            $response->getBody()->write($commentairesJson);
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            // Log the exception for debugging
            console.log($e->getMessage());

            // Return a proper error response
            return $response
                ->withStatus(500)
                ->withHeader('Content-Type', 'application/json')
                ->getBody()
                ->write(json_encode(['error' => 'Internal Server Error']));
        }
    }

}
