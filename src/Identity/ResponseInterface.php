<?php
namespace PHPAPILibrary\Core\Identity;

use PHPAPILibrary\Core\CacheControlInterface;

/**
 * Interface ResponseInterface
 * @package PHPAPILibrary\Core\Identity
 */
interface ResponseInterface
{
    /**
     * @return CacheControlInterface
     */
    public function getCacheControl(): CacheControlInterface;

    /**
     * @return array|object|null
     */
    public function getData();
}
