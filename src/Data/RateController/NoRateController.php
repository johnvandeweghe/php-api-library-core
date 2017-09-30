<?php
namespace PHPAPILibrary\Core\Data\RateController;

use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Data\RateControllerInterface;
use PHPAPILibrary\Core\Data\RequestInterface;

/**
 * A RateController that allows all requests and doesn't track them.
 * Class NoRateController
 * @package PHPAPILibrary\Core\Data\RateController
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
