<?php
namespace App\Controller;

use App\Repository\ArticlesRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Application\Exceptions\CustomNotFoundException;
use Slim\Exception\HttpInternalServerErrorException;


class PostCommentaireController extends BaseController
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
            /** @var ArticlesRepository $articlesRepository */
            $articlesRepository = $this->getRepository(ArticlesRepository::class);
            /** @var Article $article */
            $article = $articlesRepository->findOneBy([
                'slug' => $arg['slug_article'],
            ]);
            if (is_null($article)) {
                throw new CustomNotFoundException($request);
            }
            
            $idArticle = $article->getId();
            $urlArticle = $article->getUrlArticle();

            $data = $request->getParsedBody();
            if ($data) {
                
                $auteur = $data['auteur_commentaire'];
                $contenu = $data['texte_commentaire'];
            
                $this->setCommentaire($auteur, $contenu, $idArticle);
            }
            
            return $response->withHeader('Location', "/$urlArticle")->withStatus(301);
        }catch (\Exception $e) {
            throw new HttpInternalServerErrorException($request);
        }
    }

}
