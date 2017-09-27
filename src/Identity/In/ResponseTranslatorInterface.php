<?php
namespace PHPAPILibrary\Core\Identity\In;

use PHPAPILibrary\Core\Identity\ResponseInterface;

/**
 * Interface ResponseTranslatorInterface
 * @package PHPAPILibrary\Core\Identity\In
 */
interface ResponseTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Data\ResponseInterface $response
     * @return ResponseInterface
     */
    public function translateResponse(\PHPAPILibrary\Core\Data\ResponseInterface $response): ResponseInterface;
}
