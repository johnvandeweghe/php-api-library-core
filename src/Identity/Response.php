<?php
namespace PHPAPILibrary\Core\Identity;

use PHPAPILibrary\Core\CacheControl;

/**
 * Interface Response
 * @package PHPAPILibrary\Core\Identity
 */
interface Response
{
    /**
     * @return CacheControl
     */
    public function getCacheControl(): CacheControl;

    /**
     * @return array|object|null
     */
    public function getData();
}
