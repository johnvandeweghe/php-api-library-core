<?php
namespace PHPAPILibrary\Core\Data\Out\ResponseTranslator;

use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Data\Out\Exception\UnableToTranslateResponseException;

/**
 * Interface DataTranslatorInterface
 * @package PHPAPILibrary\Core\Data\Out\RequestTranslator
 */
interface DataTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Network\ResponseInterface $response
     * @return DataInterface
     * @throws UnableToTranslateResponseException
     */
    public function translateData(\PHPAPILibrary\Core\Network\ResponseInterface $response): DataInterface;
}
