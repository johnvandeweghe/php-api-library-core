<?php
namespace PHPAPILibrary\Core\Network\AccessController;

use PHPAPILibrary\Core\Network\AccessControllerInterface;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Network\RequestInterface;

/**
 * An AccessController that allows all requests.
 * Class AllowAllAccessController
 * @package PHPAPILibrary\Core\Network\AccessController
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
