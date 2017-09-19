<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;

/**
 * Interface AccessControllerInterface
 * @package PHPAPILibrary\Core\Data
 */
interface AccessControllerInterface
{
    /**
     * @param RequestInterface $request
     * @return bool
     * @throws UnableToProcessRequestException
     */
    public function canAccess(RequestInterface $request): bool;
}
