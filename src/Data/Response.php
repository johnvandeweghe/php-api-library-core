<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\CacheControl;

/**
 * Interface Response
 * @package PHPAPILibrary\Core\Data
 */
interface Response
{
    /**
     * @return CacheControl
     */
    public function getCacheControl(): CacheControl;

    /**
     * @return Data
     */
    public function getData(): Data;
}
