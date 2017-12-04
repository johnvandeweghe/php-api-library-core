<?php
namespace PHPAPILibrary\Core\Network\In\RequestTranslator;

use PHPAPILibrary\Core\Identity\IdentityInterface;
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
     * @return IdentityInterface
     * @throws UnableToTranslateRequestException
     */
    public function buildIdentity(RequestInterface $request): IdentityInterface;
}
