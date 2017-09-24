<?php
namespace PHPAPILibrary\Core\Network;

/**
 * Interface CacheControllerInterface
 * @package PHPAPILibrary\Core\Network
 */
interface CacheControllerInterface
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface|null
     */
    public function getResponse(RequestInterface $request);

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function storeResponse(RequestInterface $request, ResponseInterface $response): void;
}
