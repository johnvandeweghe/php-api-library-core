<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Data\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Data\Exception\RequestException;
use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Data\Exception\UnableToRouteRequestException;
use PHPAPILibrary\Core\Data\Response\Response;

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

        if (!$routedController) {
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
