<?php
namespace PHPAPILibrary\Core\Network\CacheController;

use PHPAPILibrary\Core\Network\CacheControllerInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Core\Network\ResponseInterface;

/**
 * A CacheControllerInterface implementation that does nothing. A no-cache solution.
 * Class NullCacheController
 * @package PHPAPILibrary\Core\Network\CacheController
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
