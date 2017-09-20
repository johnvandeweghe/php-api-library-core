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
     * @throws UnableToProcessRequestException
     */
    public function logResponse(RequestInterface $request, ResponseInterface $response): void;
}
