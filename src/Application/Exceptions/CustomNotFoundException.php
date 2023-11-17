<?php

namespace App\Application\Exceptions;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpSpecializedException;
use Throwable;

class CustomNotFoundException extends HttpSpecializedException {
    protected $customHeader;
    /**
     * @var int
     */
    protected int $code = 404;

    /**
     * @var string
     */
    protected string $message = 'Not found.';

    /**
     * @var string
     */
    protected string $title = '404 Not Found';

    /**
     * @var string
     */
    protected string $description = 'The requested resource could not be found. Please verify the URI and try again.';

    /**
     * @param ServerRequestInterface $request
     * @param string|null $request
     * @param string|null $message
     * @param string|null $previous
     */
    public function __construct(ServerRequestInterface $request, ?string $customHeader = null, ?string $message = null, ?Throwable $previous = null)
    {
        parent::__construct($request, $message, $previous);
        $this->customHeader = $customHeader;
    }

    /**
     * @return string
     */
    public function getCustomHeader(): ?string
    {
        return $this->customHeader;
    }

    /**
     * @return string
     */
    public function getTitre(): ?string
    {
        return $this->getTitle();
    }
}
