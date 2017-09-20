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
     * @throws UnableToProcessRequestException
     */
    public function logResponse(RequestInterface $request, ResponseInterface $response): void;
}
