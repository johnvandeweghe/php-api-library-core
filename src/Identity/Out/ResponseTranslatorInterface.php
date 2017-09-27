<?php
namespace PHPAPILibrary\Core\Identity\Out;

use PHPAPILibrary\Core\Identity\ResponseInterface;

/**
 * Interface ResponseTranslatorInterface
 * @package PHPAPILibrary\Core\Identity\Out
 */
interface ResponseTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Network\ResponseInterface $response
     * @return ResponseInterface
     */
    public function translateResponse(\PHPAPILibrary\Core\Network\ResponseInterface $response): ResponseInterface;
}
