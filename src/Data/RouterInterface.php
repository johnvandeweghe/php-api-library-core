<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\UnableToRouteRequestException;

/**
 * Interface RouterInterface
 * @package PHPAPILibrary\Core\Data
 */
interface RouterInterface
{
    /**
     * @param RequestInterface $request
     * @return LayerControllerInterface|null
     * @throws UnableToRouteRequestException
     */
    public function route(RequestInterface $request): ?LayerControllerInterface;
}
