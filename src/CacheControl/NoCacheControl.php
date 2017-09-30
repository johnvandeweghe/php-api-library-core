<?php
namespace PHPAPILibrary\Core\CacheControl;

use PHPAPILibrary\Core\CacheControlInterface;

class NoCacheControl implements CacheControlInterface
{
    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return true;
    }

    /**
     * @return \DateTime
     */
    public function getAbsoluteExpiration(): \DateTime
    {
        return new \DateTime("@0", new \DateTimeZone("UTC"));
    }

    /**
     * @return \DateInterval
     */
    public function getRelativeExpiration(): \DateInterval
    {
        return \DateInterval::createFromDateString('-99 days');
    }
}
