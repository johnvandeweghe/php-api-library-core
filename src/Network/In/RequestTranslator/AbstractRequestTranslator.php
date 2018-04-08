<?php
namespace PHPAPILibrary\Core\Network\In\RequestTranslator;

use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Data\IdentityInterface;
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
     * @return \PHPAPILibrary\Core\Data\RequestInterface
     * @throws UnableToTranslateRequestException
     */
    public function translateRequest(RequestInterface $request): \PHPAPILibrary\Core\Data\RequestInterface
    {
        $data = $this->getDataTranslator($request)->translateData($request);
        $identity = $this->getIdentityProvider($request)->buildIdentity($request, $data);

        return $this->buildRequest($identity, $data, $request);
    }

    /**
     * @param RequestInterface $request
     * @return IdentityProviderInterface
     */
    protected abstract function getIdentityProvider(RequestInterface $request): IdentityProviderInterface;

    /**
     * @param RequestInterface $request
     * @return DataTranslatorInterface
     * @throws UnableToTranslateRequestException
     */
    protected abstract function getDataTranslator(RequestInterface $request): DataTranslatorInterface;

    /**
     * @param null|IdentityInterface $identity
     * @param DataInterface $data
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Data\RequestInterface
     * @throws UnableToTranslateRequestException
     */
    protected abstract function buildRequest(
        ?IdentityInterface $identity, DataInterface $data, RequestInterface $request
    ): \PHPAPILibrary\Core\Data\RequestInterface;
}
