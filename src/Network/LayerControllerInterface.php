<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Network\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Network\Exception\RequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;

/**
 * Interface LayerControllerInterface
 * @package PHPAPILibrary\Core\Network
 */
interface LayerControllerInterface
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws AccessDeniedException
     * @throws RateLimitExceededException
     * @throws UnableToProcessRequestException
     */
    public function handleRequest(RequestInterface $request): ResponseInterface;

    /**
     * @return AccessControllerInterface
     */
    public function getAccessController(): AccessControllerInterface;

    /**
     * @return CacheControllerInterface
     */
    public function getCacheController(): CacheControllerInterface;

    /**
     * @return RateControllerInterface
     */
    public function getRateController(): RateControllerInterface;

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface;
}
