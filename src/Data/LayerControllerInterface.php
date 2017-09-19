<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Data\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Data\Exception\RequestException;
use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;

/**
 * Interface LayerControllerInterface
 * @package PHPAPILibrary\Core\Data
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
