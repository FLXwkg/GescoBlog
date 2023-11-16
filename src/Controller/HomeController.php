<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;


class HomeController extends BaseController
{
    public function handle($response)
    {
        try{
            $categoriesRepository = $this->getRepository(CategoriesRepository::class);
            $args['sections'] = $this->getSections($categoriesRepository);

            $articlesRepository = $this->getRepository(ArticlesRepository::class);
            $articles = $articlesRepository->getAll();
            if (is_null($articles)) {
                throw new HttpNotFoundException($request);
            }
            $args['articles'] = $articles;

            return $this->getRenderedResponse($args, 'home.php');
        }catch (\Exception $e) {
            throw $e;
        }
    }

}
