<?php


namespace Application\Support;


use Application\Configuration;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\PhpRenderer;

class TemplateFactory
{

    /**
     * @var string
     */
    protected $templatePath = 'templates';

    /**
     * @var string
     */
    protected $defaultLayout = 'layout/default.php';

    /**
     * @var ServerRequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var PhpRenderer
     */
    protected $renderer;

    /**
     * @var Configuration|null
     */
    protected $configuration;


    /**
     * TemplateFactory constructor.
     * @param ServerRequestInterface|null $request
     * @param ResponseInterface|null $response
     * @param Configuration|null $configuration
     */
    public function __construct(?ServerRequestInterface $request = null, ?ResponseInterface $response = null, Configuration $configuration = null)
    {
        if (!is_null($request)) {
            $this->setRequest($request);
        }
        if (!is_null($response)) {
            $this->setResponse($response);
        }
        if (!is_null($configuration)) {
            $this->setConfiguration($configuration);
        }
    }

    /**
     * @param string $defaultLayout
     * @return TemplateFactory
     */
    public function setDefaultLayout(string $defaultLayout): TemplateFactory
    {
        $this->defaultLayout = $defaultLayout;
        return $this;
    }


    /**
     * @param array $args
     * @param string|null $customViewPath
     * @return ResponseInterface
     * @throws \Throwable
     */
    public function getRenderedResponse(array $args = [], ?string $customViewPath = null): ResponseInterface
    {
        $renderer = $this->getRenderer($this->defaultLayout);
        $response = $this->getResponse();
        $configuration = $this->getConfiguration();
        $args = array_merge([
            'helpers' => new HelperManager($this, $configuration)
        ], $args);
        if (!is_null($configuration)) {
            $args['configuration'] = $configuration->getConfiguration();
        }
        $view = $this->getView($customViewPath);
        return $renderer->render($response, $view, $args);
    }

    /**
     * @param string $layout
     * @return PhpRenderer
     */
    public function getRenderer(string $layout): PhpRenderer
    {
        if (is_null($this->renderer)) {
            $renderer = new PhpRenderer($this->templatePath);
            $renderer->setLayout($layout);
            $this->renderer = $renderer;
        }
        return $this->renderer;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     * @return TemplateFactory
     */
    public function setResponse(ResponseInterface $response): TemplateFactory
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return Configuration|null
     */
    public function getConfiguration(): ?Configuration
    {
        return $this->configuration;
    }

    /**
     * @param Configuration|null $configuration
     * @return TemplateFactory
     */
    public function setConfiguration(?Configuration $configuration): TemplateFactory
    {
        $this->configuration = $configuration;
        return $this;
    }

    /**
     * @param string|null $customViewPath
     * @return string
     * @throws HttpNotFoundException
     */
    protected function getView(?string $customViewPath = null): string
    {
        $view = $this->getViewFilePath($customViewPath);
        $templatesPath = $this->templatePath;
        if (!file_exists($templatesPath . DIRECTORY_SEPARATOR . $view)) {
            throw new HttpNotFoundException($this->getRequest());
        }
        return $view;
    }

    /**
     * @param string|null $customViewPath
     * @return string
     */
    protected function getViewFilePath(?string $customViewPath = null): string
    {
        if (!is_null($customViewPath)) {
            return $customViewPath;
        }
        $request = $this->getRequest();
        return ltrim($request->getUri()->getPath(), '/') . '.php';
    }

    /**
     * @return ServerRequestInterface
     */
    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }

    /**
     * @param ServerRequestInterface $request
     * @return TemplateFactory
     */
    public function setRequest(ServerRequestInterface $request): TemplateFactory
    {
        $this->request = $request;
        return $this;
    }
}
