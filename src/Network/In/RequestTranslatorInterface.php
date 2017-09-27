<?php
namespace PHPAPILibrary\Core\Network\In;

use PHPAPILibrary\Core\Network\RequestInterface;

/**
 * Interface RequestTranslatorInterface
 * @package PHPAPILibrary\Core\Network\In
 */
interface RequestTranslatorInterface
{
    /**
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Identity\RequestInterface
     */
    public function translateRequest(RequestInterface $request): \PHPAPILibrary\Core\Identity\RequestInterface;
}
