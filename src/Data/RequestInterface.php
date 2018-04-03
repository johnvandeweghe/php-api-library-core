<?php
namespace PHPAPILibrary\Core\Data;

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
     * @return IdentityInterface|null
     */
    public function getIdentity(): ?IdentityInterface;

    /**
     * @return DataInterface
     */
    public function getData(): DataInterface;

}
