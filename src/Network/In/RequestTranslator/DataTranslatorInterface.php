<?php
namespace PHPAPILibrary\Core\Network\In\RequestTranslator;

use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\RequestInterface;

/**
 * Interface IdentityProviderInterface
 * @package PHPAPILibrary\Core\Network\In\RequestTranslator
 */
interface DataTranslatorInterface
{
    /**
     * @param RequestInterface $request
     * @return object|array|null
     * @throws UnableToTranslateRequestException
     */
    public function translateData(RequestInterface $request);
}
