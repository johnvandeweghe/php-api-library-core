<?php
namespace PHPAPILibrary\Core\Identity;

use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;

/**
 * Interface LoggerInterface
 * @package PHPAPILibrary\Core\Identity
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
