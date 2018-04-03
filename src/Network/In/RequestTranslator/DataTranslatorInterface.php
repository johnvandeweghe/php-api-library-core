<?php
namespace PHPAPILibrary\Core\Network\In\RequestTranslator;

use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\RequestInterface;

/**
 * Interface DataTranslatorInterface
 * @package PHPAPILibrary\Core\Network\In\RequestTranslator
 */
interface DataTranslatorInterface
{
    /**
     * @param RequestInterface $request
     * @return DataInterface
     * @throws UnableToTranslateRequestException
     */
    public function translateData(RequestInterface $request): DataInterface;
}
