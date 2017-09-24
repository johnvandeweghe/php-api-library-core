<?php
namespace PHPAPILibrary\Core\Network;

/**
 * Interface UpwardRequestTranslatorInterface
 * @package PHPAPILibrary\Core\Network
 */
interface UpwardRequestTranslatorInterface
{
    /**
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Identity\RequestInterface
     */
    public function translateRequest(RequestInterface $request): \PHPAPILibrary\Core\Identity\RequestInterface;
}
