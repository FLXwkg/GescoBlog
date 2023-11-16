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
            $args['articles'] = $articlesRepository->getAll();

            return $this->getRenderedResponse($args, 'home.php');
        }catch (\Exception $e) {
            throw new HttpInternalServerErrorException($request);
        }
    }

}
