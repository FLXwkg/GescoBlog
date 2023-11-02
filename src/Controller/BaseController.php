<?php

namespace App\Controller;

use App\Configuration;
use App\Support\TemplateFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class BaseController
{

    protected Request $request;

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


}