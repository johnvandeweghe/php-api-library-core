<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\UnableToRouteRequestException;

/**
 * A router that routes based on a request's path.
 * Class AbstractPathRouter
 * @package PHPAPILibrary\Core\Data
 */
abstract class AbstractPathRouter implements RouterInterface
{

    /**
     * @param RequestInterface $request
     * @return LayerControllerInterface
     * @throws UnableToRouteRequestException
     */
    public function route(RequestInterface $request): LayerControllerInterface
    {
        $route = $request->getPath();

        return $this->getLayerControllerFromPath($route);
    }

    /**
     * @param string $path
     * @return LayerControllerInterface
     * @throws UnableToRouteRequestException
     */
    protected abstract function getLayerControllerFromPath(string $path): LayerControllerInterface;
}
