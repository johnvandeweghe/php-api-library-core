<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Identity\IdentityInterface;

/**
 * Interface RequestInterface
 * @package PHPAPILibrary\Core\Data
 */
interface RequestInterface
{
    /**
     * @return String
     */
    public function getVerb(): String;

    /**
     * @return String
     */
    public function getPath(): String;

    /**
     * @return IdentityInterface
     */
    public function getIdentity(): IdentityInterface;

    /**
     * @return DataInterface
     */
    public function getData(): DataInterface;

}
