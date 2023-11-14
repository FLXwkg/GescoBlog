<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;


class HomeController extends BaseController
{
    public function handle($response)
    {
        $args['sections'] = $this->getSections($category);

        $articles = $this->getRepository(ArticlesRepository::class);
        $contentArticle = $articles->getAll();
        $args['articles'] = $contentArticle;

        return $this->getRenderedResponse($args, 'home.php');
    }

}
