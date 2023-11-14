<?php
namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class ArticleController extends BaseController
{
    public function handle($request, $response, $arg)
    {
        try{
            $categoriesRepository = $this->getRepository(CategoriesRepository::class);
            $category = $categoriesRepository->findOneBySlug($arg['categorie']);
            //var_dump($category);die();
            $args = [];
            $args['category'] = $category;
            $args['sections'] = $this->getSections();

            $articles = $this->getRepository(ArticlesRepository::class);
            $contentArticle = $articles->getBySlug($arg['slug_article']);
            $args['articles'] = $contentArticle;
            
            return $this->getRenderedResponse($args, 'viewArticle.php');
        }catch (\Exception $e) {
            throw new HttpInternalServerErrorException($request);
        }
    }
    
    protected function getCommentaires(int $idArticle): array
    {
        $commentaire = $this->getRepository(CommentairesRepository::class);
        return $commentaire->getByArticleId($idArticle);
    }
    
    public function handleJson(Request $request, $response, $args)
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
            throw new HttpInternalServerErrorException($request);
        }
    }

}
