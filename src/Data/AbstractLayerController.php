<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Data\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Data\Exception\RequestException;
use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Data\Response\Response;

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
        try {
            $response = $this->getResponseFromSubLayers($request);

            if (!$response) {
                $response = $this->getResponse($request);
                $this->getCacheController()->storeResponse($request, $response);
            }

            $this->getRateController()->trackRequest($request);

            $this->getLogger()->logResponse($request, $response);
        } catch (UnableToProcessRequestException $exception) {
            $this->getLogger()->logResponseException($request, $exception);

            //We caught it to log it, we can now rethrow it so it's handled properly.
            throw $exception;
        }

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
    protected function getResponseFromSubLayers(RequestInterface $request): ?ResponseInterface
    {
        if ($this->getRateController()->isExceedingLimit($request)) {
            return $this->handleRateLimitExceeded($request);
        }

        if (!$this->getAccessController()->canAccess($request)) {
            return $this->handleDeniedAccess($request);
        }

        return $this->getCacheController()->getResponse($request);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws RateLimitExceededException
     * @throws UnableToProcessRequestException
     */
    protected function handleRateLimitExceeded(RequestInterface $request): ResponseInterface
    {
        throw new RateLimitExceededException(Response::getNullResponse());
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws AccessDeniedException
     * @throws UnableToProcessRequestException
     */
    protected function handleDeniedAccess(RequestInterface $request): ResponseInterface
    {
        throw new AccessDeniedException(Response::getNullResponse());
    }

    /**
     * @return AccessControllerInterface
     */
    abstract protected function getAccessController(): AccessControllerInterface;

    /**
     * @return CacheControllerInterface
     */
    abstract protected function getCacheController(): CacheControllerInterface;

    /**
     * @return RateControllerInterface
     */
    abstract protected function getRateController(): RateControllerInterface;

    /**
     * @return LoggerInterface
     */
    abstract protected function getLogger(): LoggerInterface;

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws UnableToProcessRequestException
     */
    abstract protected function getResponse(RequestInterface $request): ResponseInterface;
}
