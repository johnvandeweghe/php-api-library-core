<?php
namespace PHPAPILibrary\Core\Network\In\RequestTranslator;

use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Data\IdentityInterface;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\RequestInterface;

/**
 * Interface IdentityProviderInterface
 * @package PHPAPILibrary\Core\Network\In\RequestTranslator
 */
interface IdentityProviderInterface
{
    /**
     * @param RequestInterface $request
     * @param DataInterface $parsedData
     * @return IdentityInterface
     * @throws UnableToTranslateRequestException
     */
    public function buildIdentity(RequestInterface $request, DataInterface $parsedData): ?IdentityInterface;
}
