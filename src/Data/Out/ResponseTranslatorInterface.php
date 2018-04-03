<?php
namespace PHPAPILibrary\Core\Data\Out;

use PHPAPILibrary\Core\Data\Out\Exception\UnableToTranslateResponseException;
use PHPAPILibrary\Core\Data\ResponseInterface;

/**
 * Interface ResponseTranslatorInterface
 * @package PHPAPILibrary\Core\Data\Out
 */
interface ResponseTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Network\ResponseInterface $response
     * @return ResponseInterface
     * @throws UnableToTranslateResponseException
     */
    public function translateResponse(\PHPAPILibrary\Core\Network\ResponseInterface $response): ResponseInterface;
}
