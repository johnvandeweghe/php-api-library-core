<?php
namespace PHPAPILibrary\Core\Identity;

use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;

/**
 * Interface LoggerInterface
 * @package PHPAPILibrary\Core\Identity
 */
interface LoggerInterface
{
    /**
     * @param RequestInterface $request
     * @throws UnableToProcessRequestException
     */
    public function logRequest(RequestInterface $request): void;
}
