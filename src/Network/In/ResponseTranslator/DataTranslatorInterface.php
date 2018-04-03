<?php
namespace PHPAPILibrary\Core\Network\In\ResponseTranslator;

use PHPAPILibrary\Core\Data\ResponseInterface;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateResponseException;
use Psr\Http\Message\StreamInterface;

/**
 * Interface DataTranslatorInterface
 * @package PHPAPILibrary\Core\Network\In\RequestTranslator
 */
interface DataTranslatorInterface
{
    /**
     * @param ResponseInterface $response
     * @return StreamInterface
     * @throws UnableToTranslateResponseException
     */
    public function translateData(ResponseInterface $response): StreamInterface;
}
