<?php
namespace PHPAPILibrary\Core;

/**
 * Interface CacheControl
 * @package PHPAPILibrary\Core
 */
interface CacheControl
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
