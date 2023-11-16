<?php

namespace App\Error\Renderer;

use Slim\Exception\HttpNotFoundException;
use Slim\Interfaces\ErrorRendererInterface;
use App\Support\TemplateFactory;
use Throwable;

class HtmlErrorRenderer
{
    protected $request;
    protected $response;

    public function __invoke(Throwable $exception, bool $displayErrorDetails): string
    {
        $args = [];
        $title = 'Error';
        $message = 'An error has occurred.';

        if ($exception instanceof HttpNotFoundException) {
            $title = 'Page not found';
            $message = 'This page could not be found.';
        }
        
        $args['title'] = htmlentities($title, ENT_COMPAT|ENT_HTML5, 'utf-8');
        $args['message'] = htmlentities($message, ENT_COMPAT|ENT_HTML5, 'utf-8');
        
        $templateFactory = new TemplateFactory($this->request, $this->response);
        return $templateFactory->getRenderedResponse($args,'layout/errors/404.php');

    }

    public function setDependencies(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}