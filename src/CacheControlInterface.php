<?php
namespace PHPAPILibrary\Core;

/**
 * Interface CacheControlInterface
 * @package PHPAPILibrary\Core
 */
interface CacheControlInterface
{
    /**
     * Whether to consider the cache item private (for a specific user) or public (so a shared cache can use it).
     * @return bool
     */
    public function isPrivate(): bool;

    /**
     * How long the cache item is valid for.
     * @return \DateInterval
     */
    public function getRelativeExpiration(): \DateInterval;
}
