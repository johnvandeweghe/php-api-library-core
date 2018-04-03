<?php
namespace PHPAPILibrary\Core\Data\Out\RequestTranslator;

use PHPAPILibrary\Core\Data\Out\Exception\UnableToTranslateRequestException;
use Psr\Http\Message\StreamInterface;

/**
 * Interface DataTranslatorInterface
 * @package PHPAPILibrary\Core\Data\Out\RequestTranslator
 */
interface DataTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Data\RequestInterface $request
     * @return StreamInterface
     * @throws UnableToTranslateRequestException
     */
    public function translateData(\PHPAPILibrary\Core\Data\RequestInterface $request): StreamInterface;
}
