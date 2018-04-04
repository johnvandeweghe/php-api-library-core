<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Data\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Data\Exception\RequestException;
use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Data\Exception\UnableToRouteRequestException;

/**
 * Class AbstractRoutingLayerController
 * @package PHPAPILibrary\Core\Data
 */
abstract class AbstractRoutingLayerController extends AbstractLayerController
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws AccessDeniedException
     * @throws RateLimitExceededException
     * @throws UnableToProcessRequestException
     * @throws UnableToRouteRequestException
     */
    protected function getResponse(RequestInterface $request): ResponseInterface
    {
        $routedController = $this->getRouter()->route($request);

        return $routedController->handleRequest($request);
    }

    /**
     * @return RouterInterface
     */
    abstract protected function getRouter(): RouterInterface;
}
