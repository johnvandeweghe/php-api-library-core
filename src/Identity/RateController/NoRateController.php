<?php
namespace PHPAPILibrary\Core\Identity\RateController;

use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Identity\RateControllerInterface;
use PHPAPILibrary\Core\Identity\RequestInterface;

/**
 * A RateController that allows all requests and doesn't track them.
 * Class NoRateController
 * @package PHPAPILibrary\Core\Identity\RateController
 */
class NoRateController implements RateControllerInterface
{
    /**
     * @param RequestInterface $request
     * @return bool
     * @throws UnableToProcessRequestException
     */
    public function isExceedingLimit(RequestInterface $request): bool
    {
        return false;
    }

    /**
     * @param RequestInterface $request
     * @throws UnableToProcessRequestException
     */
    public function trackRequest(RequestInterface $request): void
    {
        return;
    }
}
