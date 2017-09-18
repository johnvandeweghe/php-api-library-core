<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\CacheControlInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Interface ResponseInterface
 * @package PHPAPILibrary\Core\Network
 */
interface ResponseInterface
{
    /**
     * @return CacheControlInterface
     */
    public function getCacheControl(): CacheControlInterface;

    /**
     * @return StreamInterface
     */
    public function getData(): StreamInterface;

}
