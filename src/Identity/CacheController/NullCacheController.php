<?php
namespace PHPAPILibrary\Core\Identity\CacheController;

use PHPAPILibrary\Core\Identity\CacheControllerInterface;
use PHPAPILibrary\Core\Identity\RequestInterface;
use PHPAPILibrary\Core\Identity\ResponseInterface;

/**
 * A CacheControllerInterface implementation that does nothing. A no-cache solution.
 * Class NullCacheController
 * @package PHPAPILibrary\Core\Identity\CacheController
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
