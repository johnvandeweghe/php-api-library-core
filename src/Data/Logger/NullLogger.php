<?php
namespace PHPAPILibrary\Core\Data\Logger;

use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Data\LoggerInterface;
use PHPAPILibrary\Core\Data\RequestInterface;
use PHPAPILibrary\Core\Data\ResponseInterface;

/**
 * A logger that doesn't log anything.
 * Class NullLogger
 * @package PHPAPILibrary\Core\Data\Logger
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
