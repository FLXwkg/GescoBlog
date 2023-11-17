<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;


class HomeController extends BaseController
{
    public function handle($response)
    {
        $categoriesRepository = $this->getRepository(CategoriesRepository::class);
        $args['sections'] = $this->getSections($categoriesRepository);

        $articlesRepository = $this->getRepository(ArticlesRepository::class);
        $articles = $articlesRepository->getAll();
        if (is_null($articles)) {
            throw new CustomNotFoundException($request);
        }
        $args['articles'] = $articles;

        return $this->getRenderedResponse($args, 'home.php');
    }

}
