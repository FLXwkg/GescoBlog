<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Actions\ActionError;
use App\Application\Actions\ActionPayload;
use App\Configuration;
use App\Application\Exceptions\CustomNotFoundException;
use App\Support\TemplateFactory;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpException;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpNotImplementedException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Handlers\ErrorHandler as SlimErrorHandler;
use Slim\Interfaces\CallableResolverInterface;
use Throwable;

class HttpErrorHandler extends SlimErrorHandler
{
    /**
     * @var Configuration $configuration
     */
    protected Configuration $configuration;

    /**
     * @param CallableResolverInterface $callableResolver
     * @param ResponseFactoryInterface $responseFactory
     * @param LoggerInterface|null $logger
     * @param Configuration|null $configuration
     */
    public function __construct(CallableResolverInterface $callableResolver, ResponseFactoryInterface $responseFactory, ?LoggerInterface $logger = null, ?Configuration $configuration = null)
    {
        parent::__construct($callableResolver, $responseFactory, $logger);
        if (!is_null($configuration)) {
            $this->setConfiguration($configuration);
        }
    }

    /**
     * @return Configuration
     */
    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }

    /**
     * @param Configuration $configuration
     * @return HttpErrorHandler
     */
    public function setConfiguration(Configuration $configuration): HttpErrorHandler
    {
        $this->configuration = $configuration;
        return $this;
    }

    /**
     * @param Response $response
     * @return TemplateFactory
     */
    protected function createTemplateFactory(Response $response): TemplateFactory
    {
        $request = $this->request;
        $templateFactory = new TemplateFactory($request, $response, $this->getConfiguration());
        $templateFactory->setDefaultLayout('layout/default.php');
        return $templateFactory;
    }


    /**
     * @inheritdoc
     * @return Response
     */
    protected function respond(): Response
    {
        $exception = $this->exception;
        $statusCode = 500;
        $error = new ActionError(
            ActionError::SERVER_ERROR,
            'An internal error has occurred while processing your request.'
        );

        if ($exception instanceof HttpException) {
            $statusCode = $exception->getCode();
            $error->setDescription($exception->getMessage());

            if ($exception instanceof HttpNotFoundException) {
                $error->setType(ActionError::RESOURCE_NOT_FOUND);
            } elseif ($exception instanceof HttpMethodNotAllowedException) {
                $error->setType(ActionError::NOT_ALLOWED);
            } elseif ($exception instanceof HttpUnauthorizedException) {
                $error->setType(ActionError::UNAUTHENTICATED);
            } elseif ($exception instanceof HttpForbiddenException) {
                $error->setType(ActionError::INSUFFICIENT_PRIVILEGES);
            } elseif ($exception instanceof HttpBadRequestException) {
                $error->setType(ActionError::BAD_REQUEST);
            } elseif ($exception instanceof HttpNotImplementedException) {
                $error->setType(ActionError::NOT_IMPLEMENTED);
            } elseif ($exception instanceof CustomNotFoundException) {
                $error->setType(ActionError::RESOURCE_NOT_FOUND);
            }
        }

        if (
            !($exception instanceof HttpException)
            && $exception instanceof Throwable
            && $this->displayErrorDetails
        ) {
            $error->setDescription($exception->getMessage());
        }

        /** @var mixed $exception */
        $customTypeHeader = $exception->getCustomHeader();
        $isJsonRequested = ($customTypeHeader === 'application/json');

        if ($isJsonRequested) {
            $payload = new ActionPayload($statusCode, null, $error);
            $encodedPayload = json_encode($payload, JSON_PRETTY_PRINT);
            $response = $this->responseFactory->createResponse($statusCode);
            $response->getBody()->write($encodedPayload);

            return $response->withHeader('Content-Type', 'application/json');
        } else {

            $arrayPayload['statusCode'] = ':( ' . $exception->getTitre();
            $arrayPayload['errorMessage'] = $exception->getDescription();


            $response = $this->responseFactory->createResponse($statusCode);
            $templateFactory = $this->createTemplateFactory($response);
            $templateFactory->setDefaultLayout('layout/defaultError.php');
            return $templateFactory->getRenderedResponse($arrayPayload, 'errors.php');
        }
    }
}
