<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Application\Exceptions\CustomNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoryController extends BaseController
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
        $articles = $articlesRepository->getByCategory($category->getId());
        if (is_null($articles)) {
            throw new CustomNotFoundException($request);
        }
        $args['articles'] = $articles;

        return $this->getRenderedResponse($args, 'view.php');
    }
}
