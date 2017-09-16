<?php
namespace PHPAPILibrary\Core\Identity;

/**
 * Interface Request
 * @package PHPAPILibrary\Core\Identity
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
     * @return array|object|null
     */
    public function getData();

}
