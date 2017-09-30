<?php
namespace PHPAPILibrary\Core\Network\Logger;

use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Network\LoggerInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Core\Network\ResponseInterface;

/**
 * A logger that doesn't log anything.
 * Class NullLogger
 * @package PHPAPILibrary\Core\Network\Logger
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
