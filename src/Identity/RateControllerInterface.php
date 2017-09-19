<?php
namespace PHPAPILibrary\Core\Identity;

use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;

/**
 * Interface RateControllerInterface
 * @package PHPAPILibrary\Core\Identity
 */
interface RateControllerInterface
{
    /**
     * @param RequestInterface $request
     * @return bool
     * @throws UnableToProcessRequestException
     */
    public function isExceedingLimit(RequestInterface $request): bool;

    /**
     * @param RequestInterface $request
     * @throws UnableToProcessRequestException
     */
    public function trackRequest(RequestInterface $request): void;
}
