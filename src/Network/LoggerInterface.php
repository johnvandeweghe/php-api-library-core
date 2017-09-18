<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;

/**
 * Interface LoggerInterface
 * @package PHPAPILibrary\Core\Network
 */
interface LoggerInterface
{
    /**
     * @param RequestInterface $request
     * @throws UnableToProcessRequestException
     */
    public function logRequest(RequestInterface $request): void;
}
