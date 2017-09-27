<?php
namespace PHPAPILibrary\Core\Data\Out;

use PHPAPILibrary\Core\Data\ResponseInterface;

/**
 * Interface ResponseTranslatorInterface
 * @package PHPAPILibrary\Core\Data\Out
 */
interface ResponseTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Identity\ResponseInterface $response
     * @return ResponseInterface
     */
    public function translateResponse(\PHPAPILibrary\Core\Identity\ResponseInterface $response): ResponseInterface;
}
