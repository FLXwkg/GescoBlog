<?php
namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;
use Slim\Views\PhpRenderer;
class GenericController extends BaseController
{
    public function handle($response, $arg)
    {

        if ($arg['categorie'] === 'home') {
            return $response->withHeader('Location', "/")->withStatus(301);
        }
        $categoriesRepository = $this->getRepository(CategoriesRepository::class);
        $category = $categoriesRepository->findOneBySlug($arg['categorie']);
        $args = [];
        $args['category'] = $category;
        $args['sections'] = $this->getSections(); 

        $articles = $this->getRepository(ArticlesRepository::class);
        $contentArticle = $articles->getByCategory($category->getId());
        $args['articles'] = $contentArticle;

        $articleIds = [];
        /** @var Article $article */
        foreach ($args['articles'] as $article){
            $articleIds[] = $article->getId();
        }
        $args['commentaires'] = [];
        if(!empty($articleIds)){
            $args['commentaires'] = $this->getCommentaires($articleIds);
        }

        return $this->getRenderedResponse($args, 'view.php');
    }

    protected function getCommentaires($filter): array
    {
        $commentaire = $this->getRepository(CommentairesRepository::class);
        //equivalent SQL : select * from commentaire where id_article IN(1,2,3,4,5,6);
        return $commentaire->getByManyArticlesIds($filter);
    }
}
