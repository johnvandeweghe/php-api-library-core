<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Network\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Network\Exception\RequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToRouteRequestException;
use PHPAPILibrary\Core\Network\Response\Response;

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

        if(!$routedController) {
            return $this->handleControllerNotFound($request);
        }

        return $routedController->handleRequest($request);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws UnableToRouteRequestException
     */
    protected function handleControllerNotFound(RequestInterface $request): ResponseInterface
    {
        throw new UnableToRouteRequestException(Response::getNullResponse());
    }

    /**
     * @return RouterInterface
     */
    abstract protected function getRouter(): RouterInterface;
}
