<?php
namespace PHPAPILibrary\Core\Identity\In;

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
     */
    public function translateRequest(RequestInterface $request): \PHPAPILibrary\Core\Data\RequestInterface;
}
