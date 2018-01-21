<?php
namespace PHPAPILibrary\Core\Identity;

/**
 * Interface RequestInterface
 * @package PHPAPILibrary\Core\Identity
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
     * @return null|IdentityInterface
     */
    public function getIdentity(): ?IdentityInterface;

    /**
     * @return array|object|null
     */
    public function getData();

}
