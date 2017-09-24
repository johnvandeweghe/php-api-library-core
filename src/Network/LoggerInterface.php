<?php
namespace PHPAPILibrary\Core\Network;

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
}
