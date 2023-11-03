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
        $categoriesRepository = $this->getRepository(CategoriesRepository::class);
        $id = $categoriesRepository->getCatIdBySlugArticle($arg['slug_article'])[0]->getId();
        $slugArticle = $arg['slug_article'];
        $args = [];
        $args['categories'] = $categoriesRepository->GetByCatId($id);
        $args['sections'] = $categoriesRepository->GetAll();

        $articles = $this->getRepository(ArticlesRepository::class);
        $contentArticle = $articles->getBySlug($slugArticle);
        $args['articles'] = $contentArticle;

        
        $idArticle = $contentArticle[0]->getId();
        $args['commentaires'] = $this->getCommentaires($idArticle);
        
        return $this->getRenderedResponse($args, 'viewArticle.php');
    }
    
    protected function getCommentaires(int $idArticle): array
    {
        $commentaire = $this->getRepository(CommentairesRepository::class);
        return $commentaire->getByArticleId($idArticle);
    }
    
    public function handleJson($args)
    {
        $articles = $this->getRepository(ArticlesRepository::class);
        $idArticle = $args['id_article'];
        $commentaires = $this->getCommentaires($idArticle);
        $array = [];
        foreach($commentaires as $commentaire){
            $id = 0;
            $array[$id] = [
                'id_commentaire' => $commentaire->getId(),
                'auteur_commentaire' => $commentaire->getAuteur(),
                'texte_commentaire' => $commentaire->getDate(),
                'date_modification_commentaire' => $commentaire->getDateModif(),
                'id_article' => $commentaire->getIdArticle()
            ];$id++;
        };
        $commentairesJson = json_encode($array);
        //var_dump($array);die();
        return $commentairesJson;
    }
}
