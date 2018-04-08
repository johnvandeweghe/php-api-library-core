<?php
namespace PHPAPILibrary\Core\Data\Out\RequestTranslator;

use PHPAPILibrary\Core\Data\Out\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Data\Out\RequestTranslatorInterface;
use PHPAPILibrary\Core\Data\RequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class AbstractRequestTranslator
 * @package PHPAPILibrary\Core\Data\Out\RequestTranslator
 */
abstract class AbstractRequestTranslator implements RequestTranslatorInterface
{
    /**
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Network\RequestInterface
     * @throws UnableToTranslateRequestException
     */
    public function translateRequest(RequestInterface $request): \PHPAPILibrary\Core\Network\RequestInterface
    {
        $data = $this->getDataTranslator($request)->translateData($request);

        return $this->buildRequest($data, $request);
    }


    /**
     * @param RequestInterface $request
     * @return DataTranslatorInterface
     * @throws UnableToTranslateRequestException
     */
    protected abstract function getDataTranslator(RequestInterface $request): DataTranslatorInterface;

    /**
     * @param StreamInterface $data
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Network\RequestInterface
     * @throws UnableToTranslateRequestException
     */
    protected abstract function buildRequest(
       StreamInterface $data, RequestInterface $request
    ): \PHPAPILibrary\Core\Network\RequestInterface;
}
