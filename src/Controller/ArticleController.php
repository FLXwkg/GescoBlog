<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Application\Exceptions\CustomNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class ArticleController extends BaseController
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $arg
     * @throws CustomNotFoundException
     * @return Response
     */
    public function handle(Request $request, Response $response, array $arg)
    {
        /** @var CategoriesRepository $categoriesRepository */
        $categoriesRepository = $this->getRepository(CategoriesRepository::class);
        /** @var Categorie $category */
        $category = $this->getCategorie($arg['categorie'], $categoriesRepository, $request);

        $args['category'] = $category;
        $args['sections'] = $this->getSections($categoriesRepository, $request);

        /** @var ArticlesRepository $articlesRepository */
        $articlesRepository = $this->getRepository(ArticlesRepository::class);
        /** @var Article $article */
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
        
    /**
     * @param Request $request
     * @param Response $response
     * @param array $arg
     * @throws CustomNotFoundException
     * @throws \RuntimeException
     */
    public function handleJson(Request $request, Response $response, array $args)
    {
        try {
            /** @var ArticlesRepository $articlesRepository */
            $articlesRepository = $this->getRepository(ArticlesRepository::class);
            /** @var Article $article */
            $article = $articlesRepository->findOneBy(['slug' => $args['slug_article']]);
            if (is_null($article)) {
                throw new CustomNotFoundException($request, 'application/json');
            }
            $idArticle = $article->getId();
            $nbCommentsNeeded = $request->getHeader('nb-comments');//var_dump($nbCommentsNeeded);die();
            /** @var array[Commentaire] $commentaires */
            $commentaires = (!$nbCommentsNeeded == 3) ? $this->getCommentaires($idArticle, $request) : $this->get3Commentaires($idArticle, $request);

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
            throw $e;
        }
    }

    

}
