<?php
namespace App;

use Slim\Views\PhpRenderer;
class GenericController
{
    public function handle($response, $id)
    {
        $categories = new CategoriesRepository();
        $args = [];
        $args['categories'] = $categories->GetByCatId($id);
        $args['sections'] = $categories->GetAll(); 

        $articles = new ArticlesRepository();
        $contentArticle = $articles->getByCategory($id);
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

        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "view.php", $args);
    }

    protected function getCommentaires($filter): array
    {
        $commentaire = new CommentairesRepository();
        //equivalent SQL : select * from commentaire where id_article IN(1,2,3,4,5,6);
        return $commentaire->getByManyArticlesIds($filter);
    }
}
