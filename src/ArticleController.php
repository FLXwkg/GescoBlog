<?php
namespace App;

use Slim\Views\PhpRenderer;
class ArticleController
{
    public function handle($response, $slugArticle, $id)
    {
        $categories = new CategoriesRepository();
        $args['categories'] = $categories->GetNameByCatId($id);
        $args['sections'] = $categories->GetAll();

        $articles = new ArticlesRepository();
        $contentArticle = $articles->getBySlug($slugArticle);
        $args['articles'] = $contentArticle;

        
        $args['commentaires'] = $this->getCommentaires($id);

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "viewArticle.php", $args);
    }
    
    protected function getCommentaires(int $idArticle): array
    {
        $commentaire = new CommentairesRepository();
        //equivalent SQL : select * from commentaire where id_article IN(1,2,3,4,5,6);
        return $commentaire->getByArticleId($idArticle);
    }
}
