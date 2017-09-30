<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\CacheControlInterface;

/**
 * Interface ResponseInterface
 * @package PHPAPILibrary\Core\Data
 */
interface ResponseInterface
{
    /**
     * @return CacheControlInterface
     */
    public function getCacheControl(): CacheControlInterface;

    /**
     * @return DataInterface|null
     */
    public function getData(): ?DataInterface;
}
