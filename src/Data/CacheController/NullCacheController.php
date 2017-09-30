<?php
namespace PHPAPILibrary\Core\Data\CacheController;

use PHPAPILibrary\Core\Data\CacheControllerInterface;
use PHPAPILibrary\Core\Data\RequestInterface;
use PHPAPILibrary\Core\Data\ResponseInterface;

/**
 * A CacheControllerInterface implementation that does nothing. A no-cache solution.
 * Class NullCacheController
 * @package PHPAPILibrary\Core\Data\CacheController
 */
class NullCacheController implements CacheControllerInterface
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface|null
     */
    public function getResponse(RequestInterface $request)
    {
        return null;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function storeResponse(RequestInterface $request, ResponseInterface $response): void
    {
        return;
    }
}
