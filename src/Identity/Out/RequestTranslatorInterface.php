<?php
namespace PHPAPILibrary\Core\Identity\Out;

use PHPAPILibrary\Core\Identity\Out\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Identity\RequestInterface;

/**
 * Interface RequestTranslatorInterface
 * @package PHPAPILibrary\Core\Identity\Out
 */
interface RequestTranslatorInterface
{
    /**
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Network\RequestInterface
     * @throws UnableToTranslateRequestException
     */
    public function translateRequest(RequestInterface $request): \PHPAPILibrary\Core\Network\RequestInterface;
}
