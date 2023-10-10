<?php
namespace App;

use Slim\Views\PhpRenderer;

use App\Section;
use App\Categorie;
use App\Article;
use App\Commentaire;

class ArticleController
{
    protected $id;
    protected $title;

    public function __construct()
    {

    }

    public function render($request, $response, $args, $id)
    {
        $this->id = $id;
        $section = new Section();
        $args['sections'] = $section->getSections();

        $this->id = $id;
        $categorie = new Categorie($this->id);
        $args['categories'] = $categorie->getCategories();
        //var_dump($args);die();
        $article = new Article($this->id);
        $contentArticle = $article->getArticles();
        $args['articles'] = $contentArticle;
        

        if ($contentArticle) {
            $commentairesPage = [];
            if(count($contentArticle)> 0){
                for($i=0;$i<count($contentArticle);$i++){
                    $commentaire = new Commentaire($article,$i);
                    $commentairesArticle = $commentaire->getCommentaires();
                    $commentairesPage = array_merge($commentairesPage,$commentairesArticle);
                }
            }
            $args['commentaires'] = $commentairesPage;
        }

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "viewArticle.php", $args);
    }
}
