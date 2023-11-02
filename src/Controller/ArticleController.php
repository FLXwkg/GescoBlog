<?php
namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;
use Slim\Views\PhpRenderer;
class ArticleController extends BaseController
{
    public function handle($response, $arg)
    {
        $categoriesRepository = new CategoriesRepository();
        $id = $categoriesRepository->getCatIdBySlugArticle($arg['slug_article'])[0]->getId();
        $slugArticle = $arg['slug_article'];
        $args = [];
        $args['categories'] = $categoriesRepository->GetByCatId($id);
        $args['sections'] = $categoriesRepository->GetAll();

        $articles = new ArticlesRepository();
        $contentArticle = $articles->getBySlug($slugArticle);
        $args['articles'] = $contentArticle;

        
        $idArticle = $contentArticle[0]->getId();
        $args['commentaires'] = $this->getCommentaires($idArticle);
        
        return $this->getRenderedResponse($args, 'viewArticle.php');
    }
    
    protected function getCommentaires(int $idArticle): array
    {
        $commentaire = new CommentairesRepository();
        return $commentaire->getByArticleId($idArticle);
    }
}
