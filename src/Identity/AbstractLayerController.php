<?php
namespace PHPAPILibrary\Core\Identity;

use PHPAPILibrary\Core\Identity\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Identity\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Identity\Exception\RequestException;
use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;

/**
 * Class AbstractLayerController
 * @package PHPAPILibrary\Core\Network
 */
abstract class AbstractLayerController implements LayerControllerInterface
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws AccessDeniedException
     * @throws RateLimitExceededException
     * @throws UnableToProcessRequestException
     */
    public function handleRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->getResponseFromSubLayers($request);

        if(!$response) {
            $response = $this->getResponse($request);
            $this->getCacheController()->storeResponse($request, $response);
        }

        $this->getRateController()->trackRequest($request);
        $this->getLogger()->logResponse($request, $response);

        return $response;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface|null A response if one of the sub layer's returned one, null otherwise.
     * @throws RequestException
     * @throws AccessDeniedException
     * @throws RateLimitExceededException
     * @throws UnableToProcessRequestException
     */
    protected function getResponseFromSubLayers(RequestInterface $request): ResponseInterface
    {
        if($this->getRateController()->isExceedingLimit($request)) {
            return $this->handleRateLimitExceeded($request);
        }

        if(!$this->getAccessController()->canAccess($request)) {
            return $this->handleDeniedAccess($request);
        }

        return $this->getCacheController()->getResponse($request);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    abstract protected function getResponse(RequestInterface $request): ResponseInterface;

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws RateLimitExceededException
     * @throws UnableToProcessRequestException
     */
    abstract protected function handleRateLimitExceeded(RequestInterface $request): ResponseInterface;

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws AccessDeniedException
     * @throws UnableToProcessRequestException
     */
    abstract protected function handleDeniedAccess(RequestInterface $request): ResponseInterface;


}
