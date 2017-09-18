<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;

/**
 * Interface AccessControlInterface
 * @package PHPAPILibrary\Core\Data
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
