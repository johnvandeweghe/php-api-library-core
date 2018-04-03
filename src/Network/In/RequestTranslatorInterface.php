<?php
namespace PHPAPILibrary\Core\Network\In;

use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\RequestInterface;

/**
 * Interface RequestTranslatorInterface
 * @package PHPAPILibrary\Core\Network\In
 */
interface RequestTranslatorInterface
{
    /**
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Data\RequestInterface
     * @throws UnableToTranslateRequestException
     */
    public function translateRequest(RequestInterface $request): \PHPAPILibrary\Core\Data\RequestInterface;
}
