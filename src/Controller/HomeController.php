<?php

namespace App\Controller;

use App\ArticlesRepository;
use App\CategoriesRepository;
use App\CommentairesRepository;
use Slim\Views\PhpRenderer;

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
