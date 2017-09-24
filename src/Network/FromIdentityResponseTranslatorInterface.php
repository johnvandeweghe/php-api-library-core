<?php
namespace PHPAPILibrary\Core\Network;

/**
 * Interface ServerResponseTranslatorInterface
 * @package PHPAPILibrary\Core\Network
 */
interface FromIdentityResponseTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Identity\ResponseInterface $response
     * @return ResponseInterface
     */
    public function translateResponse(\PHPAPILibrary\Core\Identity\ResponseInterface $response): ResponseInterface;
}
