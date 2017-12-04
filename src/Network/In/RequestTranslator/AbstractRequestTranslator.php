<?php
namespace PHPAPILibrary\Core\Network\In\RequestTranslator;

use PHPAPILibrary\Core\Identity\IdentityInterface;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\In\RequestTranslatorInterface;
use PHPAPILibrary\Core\Network\RequestInterface;

/**
 * Class AbstractRequestTranslator
 * @package PHPAPILibrary\Core\Network\In\RequestTranslator
 */
abstract class AbstractRequestTranslator implements RequestTranslatorInterface
{
    /**
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Identity\RequestInterface
     * @throws UnableToTranslateRequestException
     */
    public function translateRequest(RequestInterface $request): \PHPAPILibrary\Core\Identity\RequestInterface
    {
        $identity = $this->getIdentityProvider()->buildIdentity($request);

        return $this->buildRequest($identity, $request);
    }

    /**
     * @return IdentityProviderInterface
     */
    public abstract function getIdentityProvider(): IdentityProviderInterface;

    /**
     * @param IdentityInterface $identity
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Identity\RequestInterface
     * @throws UnableToTranslateRequestException
     */
    protected abstract function buildRequest(
        IdentityInterface $identity, RequestInterface $request
    ): \PHPAPILibrary\Core\Identity\RequestInterface;
}
