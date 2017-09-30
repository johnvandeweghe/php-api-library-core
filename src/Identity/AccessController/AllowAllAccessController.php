<?php
namespace PHPAPILibrary\Core\Identity\AccessController;

use PHPAPILibrary\Core\Identity\AccessControllerInterface;
use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Identity\RequestInterface;

/**
 * An AccessController that allows all requests.
 * Class AllowAllAccessController
 * @package PHPAPILibrary\Core\Identity\AccessController
 */
class AllowAllAccessController implements AccessControllerInterface
{

    /**
     * @param RequestInterface $request
     * @return bool
     * @throws UnableToProcessRequestException
     */
    public function canAccess(RequestInterface $request): bool
    {
        return true;
    }
}
