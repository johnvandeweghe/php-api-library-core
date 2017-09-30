<?php
namespace PHPAPILibrary\Core\Network\RateController;

use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Network\RateControllerInterface;
use PHPAPILibrary\Core\Network\RequestInterface;

/**
 * A RateController that allows all requests and doesn't track them.
 * Class NoRateController
 * @package PHPAPILibrary\Core\Network\RateController
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
