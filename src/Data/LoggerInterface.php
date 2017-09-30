<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;

/**
 * Interface LoggerInterface
 * @package PHPAPILibrary\Core\Data
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
