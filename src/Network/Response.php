<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\CacheControl;
use Psr\Http\Message\StreamInterface;

/**
 * Interface Response
 * @package PHPAPILibrary\Core\Network
 */
interface Response
{
    /**
     * @return CacheControl
     */
    public function getCacheControl(): CacheControl;

    /**
     * @return StreamInterface
     */
    public function getData(): StreamInterface;

}
