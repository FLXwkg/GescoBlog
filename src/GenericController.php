<?php
namespace App;

use Slim\Views\PhpRenderer;

use App\Section;
use App\Categorie;
use App\ArticlesRepository;
use App\Commentaire;

class GenericController
{

    public function __construct()
    {

    }

    public function handleRoute($request, $response, $args, $id)
    {

        $section = new Section();
        $args['sections'] = $section->getSections();

        $categories = new CategoriesRepository();
        $args['categories'] = $categories->GetNameById($id);
        //var_dump($args);die();
        $articles = new ArticlesRepository();
        $contentArticle = $articles->getByCategory($id);
        $args['articles'] = $contentArticle;
        //var_dump($args);die();

        $commentairesPage = [];
        
        foreach ($args['articles'] as $article){
            //var_dump($article);die();
            $commentaire = new CommentairesRepository();
            $commentairesArticle = $commentaire->getByArticle($article);
            $commentairesPage = array_merge($commentairesPage,$commentairesArticle);
        }
        
        
        $args['commentaires'] = $commentairesPage;

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    }
}
