<?php
namespace PHPAPILibrary\Core\Identity;

use PHPAPILibrary\Core\Identity\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Identity\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Identity\Exception\RequestException;
use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;

/**
 * Interface LayerControllerInterface
 * @package PHPAPILibrary\Core\Identity
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
