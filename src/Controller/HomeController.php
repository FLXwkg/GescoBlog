<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;


class HomeController extends BaseController
{
    public function handle($response)
    {
        $categories = new CategoriesRepository();
        $args = [];
        $args['sections'] = $categories->GetAll();

        $articles = new ArticlesRepository();
        $contentArticle = $articles->getAll();
        $args['articles'] = $contentArticle;

        return $this->getRenderedResponse($args, 'home.php');
    }

}
