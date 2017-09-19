<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;

/**
 * Interface AccessControllerInterface
 * @package PHPAPILibrary\Core\Network
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
