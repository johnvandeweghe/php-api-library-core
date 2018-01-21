<?php
namespace PHPAPILibrary\Core\Network\In\RequestTranslator\IdentityProvider;

use PHPAPILibrary\Core\Identity\IdentityInterface;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\In\RequestTranslator\IdentityProviderInterface;
use PHPAPILibrary\Core\Network\RequestInterface;

/**
 * An identity provider that always returns null. Useful when you want the identity layer, with explicit non identity.
 * An example of when this would be used is when your API doesn't require identity for every request.
 * Class NullIdentityProvider
 * @package PHPAPILibrary\Core\Network\In\RequestTranslator\IdentityProvider
 */
class NullIdentityProvider implements IdentityProviderInterface
{

    /**
     * @param RequestInterface $request
     * @param object|array|null $parsedData
     * @return IdentityInterface
     * @throws UnableToTranslateRequestException
     */
    public function buildIdentity(RequestInterface $request, $parsedData): ?IdentityInterface
    {
        return null;
    }
}
