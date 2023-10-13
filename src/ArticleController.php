<?php
namespace App;

use Slim\Views\PhpRenderer;
class ArticleController
{
    public function render($request, $response, $args, $title, $id)
    {
        $categories = new CategoriesRepository();
        $args['categories'] = $categories->GetNameById($id);
        $args['sections'] = $categories->GetAll();

        $articles = new ArticlesRepository();
        $contentArticle = $articles->getByName($title);
        $args['articles'] = $contentArticle;

        $commentairesPage = [];
        foreach ($args['articles'] as $article){
            //var_dump($article);die();
            $commentaire = new CommentairesRepository();
            $commentairesArticle = $commentaire->getByArticle($article);
            $commentairesPage = array_merge($commentairesPage,$commentairesArticle);
        }
        $args['commentaires'] = $commentairesPage;

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "viewArticle.php", $args);
    }
}
