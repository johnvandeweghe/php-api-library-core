<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Network\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Network\Exception\RequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;

/**
 * Class AbstractLayerController
 * @package PHPAPILibrary\Core\Network
 */
abstract class AbstractLayerController implements LayerControllerInterface
{
    /**
     * @var AccessControllerInterface
     */
    private $accessController;
    /**
     * @var CacheControllerInterface
     */
    private $cacheController;
    /**
     * @var RateControllerInterface
     */
    private $rateController;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * AbstractLayerController constructor.
     * @param AccessControllerInterface $accessController
     * @param CacheControllerInterface $cacheController
     * @param RateControllerInterface $rateController
     * @param LoggerInterface $logger
     */
    public function __construct(
        AccessControllerInterface $accessController,
        CacheControllerInterface $cacheController,
        RateControllerInterface $rateController,
        LoggerInterface $logger
    ) {
        $this->accessController = $accessController;
        $this->cacheController = $cacheController;
        $this->rateController = $rateController;
        $this->logger = $logger;
    }

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
     * @return AccessControllerInterface
     */
    public function getAccessController(): AccessControllerInterface
    {
        return $this->accessController;
    }

    /**
     * @return CacheControllerInterface
     */
    public function getCacheController(): CacheControllerInterface
    {
        return $this->cacheController;
    }

    /**
     * @return RateControllerInterface
     */
    public function getRateController(): RateControllerInterface
    {
        return $this->rateController;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws UnableToProcessRequestException
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
