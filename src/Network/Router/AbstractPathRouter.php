<?php
namespace PHPAPILibrary\Core\Network\Router;

use PHPAPILibrary\Core\Network\Exception\UnableToRouteRequestException;
use PHPAPILibrary\Core\Network\LayerControllerInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Core\Network\RouterInterface;

/**
 * A router that routes based on a request's path.
 * Class AbstractPathRouter
 * @package PHPAPILibrary\Core\Network
 */
abstract class AbstractPathRouter implements RouterInterface
{

    /**
     * @param RequestInterface $request
     * @return LayerControllerInterface|null
     * @throws UnableToRouteRequestException
     */
    public function route(RequestInterface $request): ?LayerControllerInterface
    {
        $route = $request->getPath();

        return $this->getLayerControllerFromPath($route);
    }

    /**
     * @param string $path
     * @return LayerControllerInterface|null
     * @throws UnableToRouteRequestException
     */
    protected abstract function getLayerControllerFromPath(string $path): ?LayerControllerInterface;
}
