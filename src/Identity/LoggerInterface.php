<?php
namespace PHPAPILibrary\Core\Identity;

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
}
