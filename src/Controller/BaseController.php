<?php

namespace App\Controller;

use App\Configuration;
use App\Entity\Categorie;
use App\Repository\BaseRepository;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;
use App\Support\TemplateFactory;
use Psr\Http\Message\ResponseInterface;
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
    public function getRenderedResponse(array $args = [], ?string $customViewPath = null): ResponseInterface
    {
        $args = array_merge([
            'request' => $this->request
        ], $args);
        return $this->getTemplateFactory()->getRenderedResponse($args,$customViewPath);
    }

    protected function getRepository($class)
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

    protected function getSections($categoriesRepository)
    {
        $sections = $categoriesRepository->getAll();
        if (is_null($sections)) {
            throw new HttpNotFoundException($request);
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
            throw new HttpNotFoundException($request);
        }
        return $commentaires;
    }

    protected function get3Commentaires(int $idArticle): array
    {
        $commentairesRepository = $this->getRepository(CommentairesRepository::class);
        $commentaires = $commentairesRepository->get3ByArticleId($idArticle);
        if (is_null($commentaires)) {
            throw new HttpNotFoundException($request);
        }
        return $commentaires;
    }

    protected function getCategorie(string $slugCategorie,CategoriesRepository $categoriesRepository)
    {
        $category = $categoriesRepository->findOneBySlug($slugCategorie);
        if (is_null($category)) {
            throw new HttpNotFoundException($request);
        }
        return $category;
    }
}