<?php

namespace App\Controller;

use App\Configuration;
use App\Entity\Categorie;
use App\Repository\BaseRepository;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;
use App\Application\Exceptions\CustomNotFoundException;
use App\Support\TemplateFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class BaseController
{

    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Configuration
     */
    protected Configuration $configuration;

    /**
     * @var TemplateFactory
     */
    protected TemplateFactory $templateFactory;

    /**
     * @param Request $request
     * @param Response $response
     * @param Configuration $configuration
     */
    public function __construct(Request $request, Response $response, Configuration $configuration)
    {
        $this->request = $request;
        $this->configuration = $configuration;
        $this->templateFactory = $this->createTemplateFactory($request, $response, $configuration);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param Configuration $configuration
     * @return TemplateFactory
     */
    protected function createTemplateFactory(Request $request, Response $response, Configuration $configuration): TemplateFactory
    {
        $templateFactory = new TemplateFactory($request, $response, $configuration);
        $templateFactory->setDefaultLayout('layout/default.php');
        return $templateFactory;
    }

    /**
     * @return TemplateFactory
     */
    public function getTemplateFactory(): TemplateFactory
    {
        return $this->templateFactory;
    }

    /**
     * @param array $args
     * @param string|null $customViewPath
     * @return Response
     * @throws \Throwable
     */
    public function getRenderedResponse(array $args = [], ?string $customViewPath = null): Response
    {
        $args = array_merge([
            'request' => $this->request
        ], $args);
        return $this->getTemplateFactory()->getRenderedResponse($args,$customViewPath);
    }

    /**
     * @param string $class
     * @return BaseRepository
     */
    protected function getRepository(string $class): BaseRepository
    {
        $conf = $this->configuration->getConfiguration();
        $array = [
            'host' => $conf['host'],
            'name' => $conf['name'],
            'login' => $conf['login'],
            'password' => $conf['password'],
        ];
        return BaseRepository::createRepository($class, $array);
    }

    /**
     * @param CategoriesRepository $categoriesRepository
     * @return Categorie[]
     * @throws CustomNotFoundException
     */
    protected function getSections(CategoriesRepository $categoriesRepository): array
    {
        $sections = $categoriesRepository->getAll();
        if (is_null($sections)) {
            throw new CustomNotFoundException($request);
        }
        return $sections;
    }

    /**
     * @param int $idArticle
     * @return Commentaire[]
     */
    protected function getCommentaires(int $idArticle): array
    {
        $commentairesRepository = $this->getRepository(CommentairesRepository::class);
        $commentaires = $commentairesRepository->getByArticleId($idArticle);
        if (is_null($commentaires)) {
            throw new CustomNotFoundException($request, 'application/json');
        }
        return $commentaires;
    }

    /**
     * @param int $idArticle
     * @return Commentaire[]
     */
    protected function get3Commentaires(int $idArticle): array
    {
        $commentairesRepository = $this->getRepository(CommentairesRepository::class);
        $commentaires = $commentairesRepository->get3ByArticleId($idArticle);
        if (is_null($commentaires)) {
            throw new CustomNotFoundException($request, 'application/json');
        }
        return $commentaires;
    }

    /**
     * @param string $slugCategorie
     * @param CategoriesRepository $categoriesRepository
     * @return Categorie
     * @throws CustomNotFoundException
     */
    protected function getCategorie(string $slugCategorie, CategoriesRepository $categoriesRepository): Categorie 
    {
        $category = $categoriesRepository->findOneBySlug($slugCategorie);
        if (is_null($category)) {
            throw new CustomNotFoundException($request);
        }
        return $category;
    }

    /**
     * @param string $auteur
     * @param string $contenu
     * @param int $idArticle
     */
    protected function setCommentaire(string $auteur, string $contenu, int $idArticle)
    {
        $commentaire = $this->getRepository(CommentairesRepository::class);
        $commentaire->setCommentaire($auteur, $contenu, $idArticle);
    }

    /**
     * @param string $titre
     * @param string $auteur
     * @param string $contenu
     * @param int $idCategorie
     */
    protected function setArticle(string $titre, string $auteur, string $contenu, int $idCategorie)
    {
        $article = $this->getRepository(ArticlesRepository::class);
        $article->setArticle($titre, $auteur, $contenu, $idCategorie);
    }
}