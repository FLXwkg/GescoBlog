<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpNotFoundException;

class GenericController extends BaseController
{
    public function handle($request, $response, $arg)
    {
        $categoriesRepository = $this->getRepository(CategoriesRepository::class);    
        $category = $this->getCategorie($arg['categorie'], $categoriesRepository);
            
        $args['category'] = $category;
        $args['sections'] = $this->getSections($categoriesRepository);

        $articlesRepository = $this->getRepository(ArticlesRepository::class);
        $articles = $articlesRepository->getByCategory($category->getId());
        if (is_null($articles)) {
            throw new HttpNotFoundException($request);
        }
        $args['articles'] = $articles;

        return $this->getRenderedResponse($args, 'view.php');
    }
}
