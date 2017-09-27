<?php
namespace PHPAPILibrary\Core\Network\In;

use PHPAPILibrary\Core\Network\ResponseInterface;

/**
 * Interface ResponseTranslatorInterface
 * @package PHPAPILibrary\Core\Network\In
 */
interface ResponseTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Identity\ResponseInterface $response
     * @return ResponseInterface
     */
    public function translateResponse(\PHPAPILibrary\Core\Identity\ResponseInterface $response): ResponseInterface;
}
