<?php
namespace PHPAPILibrary\Core\Identity;

use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;

/**
 * Interface CacheControllerInterface
 * @package PHPAPILibrary\Core\Identity
 */
interface CacheControllerInterface
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws UnableToProcessRequestException
     */
    public function getResponse(RequestInterface $request): ResponseInterface;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @throws UnableToProcessRequestException
     */
    public function storeResponse(RequestInterface $request, ResponseInterface $response): void;
}
