<?php
namespace PHPAPILibrary\Core\Network;

/**
 * Interface ToIdentityRequestTranslatorInterface
 * @package PHPAPILibrary\Core\Network
 */
interface ToIdentityRequestTranslatorInterface
{
    /**
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Identity\RequestInterface
     */
    public function translateRequest(RequestInterface $request): \PHPAPILibrary\Core\Identity\RequestInterface;
}
