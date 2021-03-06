<?php
namespace PHPAPILibrary\Core\Data\Router;

use PHPAPILibrary\Core\Data\Exception\UnableToRouteRequestException;
use PHPAPILibrary\Core\Data\LayerControllerInterface;
use PHPAPILibrary\Core\Data\RequestInterface;
use PHPAPILibrary\Core\Data\RouterInterface;

/**
 * A router that routes based on a request's path.
 * Class AbstractPathRouter
 * @package PHPAPILibrary\Core\Data
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
