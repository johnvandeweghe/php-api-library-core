<?php
namespace PHPAPILibrary\Core\Network\In\ResponseTranslator;

use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Identity\ResponseInterface;
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
     * @throws UnableToTranslateRequestException
     */
    public function translateData(ResponseInterface $response): StreamInterface;
}
