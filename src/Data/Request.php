<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Identity\Identity;

/**
 * Interface Request
 * @package PHPAPILibrary\Core\Data
 */
interface Request
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
     * @return Identity
     */
    public function getIdentity(): Identity;

    /**
     * @return Data
     */
    public function getData(): Data;

}
