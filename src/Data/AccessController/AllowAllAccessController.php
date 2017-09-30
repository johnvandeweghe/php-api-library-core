<?php
namespace PHPAPILibrary\Core\Data\AccessController;

use PHPAPILibrary\Core\Data\AccessControllerInterface;
use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Data\RequestInterface;

/**
 * An AccessController that allows all requests.
 * Class AllowAllAccessController
 * @package PHPAPILibrary\Core\Data\AccessController
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
