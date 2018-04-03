<?php
namespace PHPAPILibrary\Core\Network\In;

use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateResponseException;
use PHPAPILibrary\Core\Network\ResponseInterface;

/**
 * Interface ResponseTranslatorInterface
 * @package PHPAPILibrary\Core\Network\In
 */
interface ResponseTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Data\ResponseInterface $response
     * @return ResponseInterface
     * @throws UnableToTranslateResponseException
     */
    public function translateResponse(\PHPAPILibrary\Core\Data\ResponseInterface $response): ResponseInterface;
}
