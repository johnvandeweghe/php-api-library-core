<?php
namespace PHPAPILibrary\Core\Network\In\ResponseTranslator;

use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateResponseException;
use PHPAPILibrary\Core\Network\In\ResponseTranslatorInterface;
use PHPAPILibrary\Core\Network\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class AbstractRequestTranslator
 * @package PHPAPILibrary\Core\Network\In\ResponseTranslator
 */
abstract class AbstractResponseTranslator implements ResponseTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Data\ResponseInterface $response
     * @return ResponseInterface
     * @throws UnableToTranslateResponseException
     */
    public function translateResponse(\PHPAPILibrary\Core\Data\ResponseInterface $response): ResponseInterface
    {
        $data = $this->getDataTranslator($response)->translateData($response);

        return $this->buildResponse($data, $response);
    }

    /**
     * @param \PHPAPILibrary\Core\Data\ResponseInterface $response
     * @return DataTranslatorInterface
     * @throws UnableToTranslateResponseException
     */
    protected abstract function getDataTranslator(\PHPAPILibrary\Core\Data\ResponseInterface $response): DataTranslatorInterface;

    /**
     * @param StreamInterface $data
     * @param \PHPAPILibrary\Core\Data\ResponseInterface $response
     * @return ResponseInterface
     * @throws UnableToTranslateResponseException
     */
    protected abstract function buildResponse(
        StreamInterface $data, \PHPAPILibrary\Core\Data\ResponseInterface $response
    ): ResponseInterface;
}
