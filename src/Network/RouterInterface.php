<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\UnableToRouteRequestException;

/**
 * Interface RouterInterface
 * @package PHPAPILibrary\Core\Network
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
