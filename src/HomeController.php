<?php
namespace App;

use Slim\Views\PhpRenderer;
class HomeController extends GenericController
{
    public function handleRoute($request, $response, $args, $id)
    {
        $categories = new CategoriesRepository();
        $args['categories'] = $categories->GetNameById($id);
        $args['sections'] = $categories->GetAll();

        $articles = new ArticlesRepository();
        $contentArticle = $articles->getAll();
        $args['articles'] = $contentArticle;
        
        $commentairesPage = [];
        foreach ($args['articles'] as $article){
            $commentaire = new CommentairesRepository();
            $commentairesArticle = $commentaire->getByArticle($article);
            $commentairesPage = array_merge($commentairesPage,$commentairesArticle);
        }
        $args['commentaires'] = $commentairesPage;
        
        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    }
}
