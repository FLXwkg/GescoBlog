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
        //var_dump($contentArticle);die();


        return $this->getRenderedResponse($args, 'home.php');
    }
    
    protected function getCommentaires($filter): array
    {
        $commentaire = new CommentairesRepository();
        //equivalent SQL : select * from commentaire where id_article IN(1,2,3,4,5,6);
        return $commentaire->getByManyArticlesIds($filter);
    }
}
