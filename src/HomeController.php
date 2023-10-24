<?php
namespace App;

use Slim\Views\PhpRenderer;
class HomeController extends GenericController
{
    public function handle($response)
    {
        $categories = new CategoriesRepository();
        $args = [];
        $args['sections'] = $categories->GetAll();

        $articles = new ArticlesRepository();
        $contentArticle = $articles->getAll();
        $args['articles'] = $contentArticle;

        $commentairesRepository = new CommentairesRepository();
        $commentairesPage = [];
        foreach ($args['articles'] as $article){
            $commentairesArticle = $commentairesRepository->getByArticle($article);
            $commentairesPage = array_merge($commentairesPage,$commentairesArticle);
        }
        $args['commentaires'] = $commentairesPage;
        
        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    }
}
