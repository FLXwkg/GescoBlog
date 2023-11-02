<?php
namespace App\Controller;

use App\ArticlesRepository;
use App\CategoriesRepository;
use App\CommentairesRepository;
use Slim\Views\PhpRenderer;
class ArticleController extends BaseController
{
    public function handle($response, $slugArticle, $id)
    {
        $categories = new CategoriesRepository();
        $args = [];
        $args['categories'] = $categories->GetByCatId($id);
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
