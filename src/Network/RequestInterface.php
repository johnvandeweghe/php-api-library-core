<?php
namespace PHPAPILibrary\Core\Network;

use Psr\Http\Message\StreamInterface;

/**
 * Interface RequestInterface
 * @package PHPAPILibrary\Core\Network
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
     * While this is the Stream from the HTTP PSR, HTTP is not required.
     * @return StreamInterface The data for the request.
     */
    public function getData(): StreamInterface;
}
