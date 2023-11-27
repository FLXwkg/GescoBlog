<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Application\Exceptions\CustomNotFoundException;


class HomeController extends BaseController
{
    /**
     * @param Request $request
     * @param Response $response
     * @throws CustomNotFoundException
     * @return Response
     */
    public function handle(Request $request, Response $response)
    {
        /** @var CategoriesRepository $categoriesRepository */
        $categoriesRepository = $this->getRepository(CategoriesRepository::class);
        $args['sections'] = $this->getSections($categoriesRepository, $request);

        /** @var ArticlesRepository $articlesRepository */
        $articlesRepository = $this->getRepository(ArticlesRepository::class);
        /** @var Article $articles */
        $articles = $articlesRepository->getAll();
        if (is_null($articles)) {
            throw new CustomNotFoundException($request);
        }
        $args['articles'] = $articles;

        return $this->getRenderedResponse($args, 'home.php');
    }

}
