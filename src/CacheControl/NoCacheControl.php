<?php
namespace PHPAPILibrary\Core\CacheControl;

use PHPAPILibrary\Core\CacheControlInterface;

class NoCacheControl implements CacheControlInterface
{
    /**
     * @return \DateInterval
     */
    public function getRelativeExpiration(): \DateInterval
    {
        return \DateInterval::createFromDateString('-99 days');
    }

    /**
     * Whether to consider the cache private (for a specific user) or public (so a shared cache can use it).
     * @return bool
     */
    public function isPrivate(): bool
    {
        return true;
    }
}
