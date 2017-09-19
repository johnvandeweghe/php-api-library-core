<?php
namespace PHPAPILibrary\Core\Identity;

use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;

/**
 * Interface AccessControllerInterface
 * @package PHPAPILibrary\Core\Identity
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
