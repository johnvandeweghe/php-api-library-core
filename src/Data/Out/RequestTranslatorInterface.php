<?php
namespace PHPAPILibrary\Core\Data\Out;

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
     */
    public function translateRequest(RequestInterface $request): \PHPAPILibrary\Core\Identity\RequestInterface;
}
