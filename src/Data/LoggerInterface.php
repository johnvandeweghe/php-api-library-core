<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;

/**
 * Interface LoggerInterface
 * @package PHPAPILibrary\Core\Data
 */
interface LoggerInterface
{
    /**
     * @param RequestInterface $request
     * @throws UnableToProcessRequestException
     */
    public function logRequest(RequestInterface $request): void;
}
