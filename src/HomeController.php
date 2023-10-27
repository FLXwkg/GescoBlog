<?php
namespace App;

use Slim\Views\PhpRenderer;
class HomeController
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
    
        
        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "home.php", $args);
    }
    
    protected function getCommentaires($filter): array
    {
        $commentaire = new CommentairesRepository();
        //equivalent SQL : select * from commentaire where id_article IN(1,2,3,4,5,6);
        return $commentaire->getByManyArticlesIds($filter);
    }
}
