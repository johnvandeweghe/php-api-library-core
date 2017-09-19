<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;

/**
 * Interface RateControllerInterface
 * @package PHPAPILibrary\Core\Data
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
