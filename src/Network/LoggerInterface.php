<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;

/**
 * Interface LoggerInterface
 * @package PHPAPILibrary\Core\Network
 */
interface LoggerInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function logResponse(RequestInterface $request, ResponseInterface $response): void;

    /**
     * @param RequestInterface $request
     * @param UnableToProcessRequestException $response
     */
    public function logResponseException(RequestInterface $request, UnableToProcessRequestException $response): void;
}
