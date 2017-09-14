<?php
namespace PHPAPILibrary\Core\Network;

use Psr\Http\Message\StreamInterface;

/**
 * Interface Request
 * @package PHPAPILibrary\Core\Network
 */
interface Request {
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
