<?php
namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;

class GenericController extends BaseController
{
    public function handle($response, $arg)
    {
        try{
            if ($arg['categorie'] === 'home') {
                return $response->withHeader('Location', "/")->withStatus(301);
            }
            $categoriesRepository = $this->getRepository(CategoriesRepository::class);
            $category = $categoriesRepository->findOneBySlug($arg['categorie']);
            
            $args['category'] = $category;
            $args['sections'] = $this->getSections($categoriesRepository); 

            $articlesRepository = $this->getRepository(ArticlesRepository::class);
            $args['articles'] = $articlesRepository->getByCategory($category->getId());

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
        }catch (\Exception $e) {
            throw new HttpInternalServerErrorException($request);
        }
    }

    protected function getCommentaires($filter): array
    {
        $commentaire = $this->getRepository(CommentairesRepository::class);
        //equivalent SQL : select * from commentaire where id_article IN(1,2,3,4,5,6);
        return $commentaire->getByManyArticlesIds($filter);
    }
}
