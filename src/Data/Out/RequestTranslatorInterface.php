<?php
namespace PHPAPILibrary\Core\Data\Out;

use PHPAPILibrary\Core\Data\Out\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Data\RequestInterface;

/**
 * Interface RequestTranslatorInterface
 * @package PHPAPILibrary\Core\Data\Out
 */
interface RequestTranslatorInterface
{
    /**
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Identity\RequestInterface
     * @throws UnableToTranslateRequestException
     */
    public function translateRequest(RequestInterface $request): \PHPAPILibrary\Core\Identity\RequestInterface;
}
