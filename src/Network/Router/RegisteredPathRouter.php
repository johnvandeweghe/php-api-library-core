<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\UnableToRouteRequestException;

/**
 * A router that routes on pre-registered paths.
 * Class RegisteredPathRouter
 * @package PHPAPILibrary\Core\Network
 */
class RegisteredPathRouter extends AbstractPathRouter
{
    /**
     * @var LayerControllerInterface[]
     */
    protected $routes;
    /**
     * @var bool
     */
    private $caseSensitive;

    /**
     * Router constructor.
     * @param LayerControllerInterface[] $routes Path keyed array of layer controllers
     * @param bool $caseSensitive
     */
    public function __construct(array $routes = [], bool $caseSensitive = false)
    {
        $this->routes = $routes;
        $this->caseSensitive = $caseSensitive;
    }

    /**
     * @param string $route
     * @param LayerControllerInterface $layerController
     * @param bool $replace Replace existing routes that collide
     */
    public function addRoute(string $route, LayerControllerInterface $layerController, bool $replace = true): void
    {
        if(!$this->caseSensitive) {
            $route = strtolower($route);
        }

        if(!isset($this->routes[$route]) || $replace) {
            $this->routes[$route] = $layerController;
        }
    }

    /**
     * @param string $path
     * @return LayerControllerInterface|null
     * @throws UnableToRouteRequestException
     */
    protected function getLayerControllerFromPath(string $path): ?LayerControllerInterface
    {
        if(!$this->caseSensitive) {
            $path = strtolower($path);
        }

        return $this->routes[$path] ?? null;
    }
}