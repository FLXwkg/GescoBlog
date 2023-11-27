<?php
namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Application\Exceptions\CustomNotFoundException;
use Slim\Exception\HttpInternalServerErrorException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostArticleController extends BaseController
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $arg
     * @throws CustomNotFoundException
     * @throws HttpInternalServerErrorException
     * @return Response
     */
    public function handle(Request $request, Response $response, array $arg)
    {
        try{
            $categoryName = $arg['categorie'];
            /** @var CategoriesRepository $categoriesRepository */
            $categoriesRepository = $this->getRepository(CategoriesRepository::class);
            /** @var Categorie $categorie */
            $category = $this->getCategorie($categoryName, $categoriesRepository, $request);
            if (is_null($category)) {
                throw new CustomNotFoundException($request);
            }

            $data = $request->getParsedBody();
            if ($data) {
                
                $titre = $data['titre_article'];
                $auteur = $data['auteur_article'];
                $contenu = $data['texte_article'];
            
                $this->setArticle($titre, $auteur, $contenu, $category->getId());
            }
            
            return $response->withHeader('Location', "/$categoryName")->withStatus(301);
        }catch (\Exception $e) {
            throw new HttpInternalServerErrorException($request);
        }
    }
}
