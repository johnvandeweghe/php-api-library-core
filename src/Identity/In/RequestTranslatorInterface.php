<?php
namespace PHPAPILibrary\Core\Identity\In;

use PHPAPILibrary\Core\Identity\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Identity\RequestInterface;

/**
 * Interface RequestTranslatorInterface
 * @package PHPAPILibrary\Core\Identity\In
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
