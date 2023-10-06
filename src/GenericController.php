<?php
namespace App;

use Slim\Views\PhpRenderer;

use App\Categorie;
use App\Article;
use App\Commentaire;

class GenericController
{
    protected $id;

    public function __construct()
    {

    }

    public function handleRoute($request, $response, $args, int $id)
    {
        $this->id = $id;
        $categorie = new Categorie($this->id);
        $args['categories'] = $categorie->getCategories();
        
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
        return $renderer->render($response, "view.php", $args);
    }
}
