<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;

/**
 * Interface RateControllerInterface
 * @package PHPAPILibrary\Core\Network
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
