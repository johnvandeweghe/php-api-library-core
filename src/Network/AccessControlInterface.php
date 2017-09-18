<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;

/**
 * Interface AccessControlInterface
 * @package PHPAPILibrary\Core\Network
 */
interface AccessControlInterface
{
    /**
     * @param RequestInterface $request
     * @return bool
     * @throws UnableToProcessRequestException
     */
    public function canAccess(RequestInterface $request): bool;
}
