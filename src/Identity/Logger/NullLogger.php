<?php
namespace PHPAPILibrary\Core\Identity\Logger;

use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Identity\LoggerInterface;
use PHPAPILibrary\Core\Identity\RequestInterface;
use PHPAPILibrary\Core\Identity\ResponseInterface;

/**
 * A logger that doesn't log anything.
 * Class NullLogger
 * @package PHPAPILibrary\Core\Identity\Logger
 */
class NullLogger implements LoggerInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function logResponse(RequestInterface $request, ResponseInterface $response): void
    {
        return;
    }

    /**
     * @param RequestInterface $request
     * @param UnableToProcessRequestException $response
     */
    public function logResponseException(RequestInterface $request, UnableToProcessRequestException $response): void
    {
        return;
    }
}
