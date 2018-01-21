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
        $data = $this->getDataTranslator()->translateData($request);
        $identity = $this->getIdentityProvider()->buildIdentity($request, $data);

        return $this->buildRequest($identity, $data, $request);
    }

    /**
     * @return IdentityProviderInterface
     */
    protected abstract function getIdentityProvider(): IdentityProviderInterface;

    /**
     * @return DataTranslatorInterface
     * @throws UnableToTranslateRequestException
     */
    protected abstract function getDataTranslator(): DataTranslatorInterface;

    /**
     * @param null|IdentityInterface $identity
     * @param array|object|null $data
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Identity\RequestInterface
     * @throws UnableToTranslateRequestException
     */
    protected abstract function buildRequest(
        ?IdentityInterface $identity, $data, RequestInterface $request
    ): \PHPAPILibrary\Core\Identity\RequestInterface;
}
