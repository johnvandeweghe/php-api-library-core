<?php
namespace PHPAPILibrary\Core\Data;

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
}
