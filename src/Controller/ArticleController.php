<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\PhpRenderer;

class ArticleController extends BaseController
{
    public function handle($request, $response, $arg)
    {
        $categoriesRepository = $this->getRepository(CategoriesRepository::class);
        /** @var Categorie $category */
        $category = $categoriesRepository->findOneBySlug($arg['categorie']);
        if (is_null($category)) {
            throw new HttpNotFoundException($request);
        }

        $args['category'] = $category;
        $args['sections'] = $this->getSections($categoriesRepository);

        /** @var ArticlesRepository $articlesRepository */
        $articlesRepository = $this->getRepository(ArticlesRepository::class);
        $article = $articlesRepository->findOneBy([
            'slug' => $arg['slug_article'],
            'id_categorie' => $category->getId(),
        ]);
        if (is_null($article)) {
            throw new HttpNotFoundException($request);
        }
        $args['article'] = $article;

        return $this->getRenderedResponse($args, 'viewArticle.php');
    }

    public function handleJson($request, $response, $args)
    {
        try {
            $articles = $this->getRepository(ArticlesRepository::class);
            $idArticle = $articles->findOneBySlug($args['slug_article'])->getId();
            $nbCommentsNeeded = $request->getHeader('nbComments');
            $commentaires = (!$nbCommentsNeeded == 3) ? $this->getCommentaires($idArticle) : $this->get3Commentaires($idArticle);

            $array = [];
            foreach ($commentaires as $commentaire) {
                $array[] = $commentaire->toArray();
            }
            $commentairesJson = json_encode($array);

            if ($commentairesJson === false) {
                throw new \RuntimeException('JSON encoding error');
            }

            $response->getBody()->write($commentairesJson);
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            // Log the exception for debugging
            throw $e;
        }
    }

    

}
