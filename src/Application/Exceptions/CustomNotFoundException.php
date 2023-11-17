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
    protected $code = 404;

    /**
     * @var string
     */
    protected $message = 'Not found.';

    protected string $title = '404 Not Found';
    protected string $description = 'The requested resource could not be found. Please verify the URI and try again.';

    public function __construct(ServerRequestInterface $request, ?string $customHeader = null, ?string $message = null, ?Throwable $previous = null)
    {
        parent::__construct($request, $message, $previous);
        $this->customHeader = $customHeader;
    }

    public function getCustomHeader(): ?string
    {
        return $this->customHeader;
    }

    public function getTitre(): ?string
    {
        return $this->getTitle();
    }
}
