<?php
namespace PHPAPILibrary\Core;

/**
 * Interface CacheControlInterface
 * @package PHPAPILibrary\Core
 */
interface CacheControlInterface
{
    /**
     * @return bool
     */
    public function isExpired(): bool;

    /**
     * @return \DateTime
     */
    public function getAbsoluteExpiration(): \DateTime;

    /**
     * @return \DateInterval
     */
    public function getRelativeExpiration(): \DateInterval;
}
