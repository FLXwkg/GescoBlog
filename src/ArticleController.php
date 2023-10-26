<?php
namespace App;

use Slim\Views\PhpRenderer;
class ArticleController
{
    public function handle($response, $slugArticle, $id)
    {
        $categories = new CategoriesRepository();
        $args = [];
        $args['categories'] = $categories->GetNameByCatId($id);
        $args['sections'] = $categories->GetAll();

        $articles = new ArticlesRepository();
        $contentArticle = $articles->getBySlug($slugArticle);
        $args['articles'] = $contentArticle;

        
        $idArticle = $contentArticle[0]->getId();
        $args['commentaires'] = $this->getCommentaires($idArticle);
        
        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "viewArticle.php", $args);
    }
    
    protected function getCommentaires(int $idArticle): array
    {
        $commentaire = new CommentairesRepository();
        return $commentaire->getByArticleId($idArticle);
    }
}
