<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;
use App\Application\Exceptions\CustomNotFoundException;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class ArticleController extends BaseController
{
    public function handle($request, $response, $arg)
    {
        $categoriesRepository = $this->getRepository(CategoriesRepository::class);
        /** @var Categorie $category */
        $category = $this->getCategorie($arg['categorie'], $categoriesRepository);

        $args['category'] = $category;
        $args['sections'] = $this->getSections($categoriesRepository);

        /** @var ArticlesRepository $articlesRepository */
        $articlesRepository = $this->getRepository(ArticlesRepository::class);
        $article = $articlesRepository->findOneBy([
            'slug' => $arg['slug_article'],
            'id_categorie' => $category->getId(),
        ]);
        if (is_null($article)) {
            throw new CustomNotFoundException($request);
        }
        $args['article'] = $article;
        

        return $this->getRenderedResponse($args, 'viewArticle.php');
    }
        

    public function handleJson($request, $response, $args)
    {
        try {
            $articlesRepository = $this->getRepository(ArticlesRepository::class);
            $article = $articlesRepository->findOneBy(['slug' => $args['slug_article']]);
            if (is_null($article)) {
                throw new CustomNotFoundException($request, 'application/json');
            }
            $idArticle = $article->getId();
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
