<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Network\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Network\Exception\RequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToRouteRequestException;

/**
 * Class AbstractRoutingLayerController
 * @package PHPAPILibrary\Core\Network
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
