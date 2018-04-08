<?php
namespace PHPAPILibrary\Core\Data\Out\ResponseTranslator;

use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Data\Out\Exception\UnableToTranslateResponseException;
use PHPAPILibrary\Core\Data\Out\ResponseTranslatorInterface;
use PHPAPILibrary\Core\Data\ResponseInterface;

/**
 * Class AbstractRequestTranslator
 * @package PHPAPILibrary\Core\Data\Out\ResponseTranslator
 */
abstract class AbstractResponseTranslator implements ResponseTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Network\ResponseInterface $response
     * @return ResponseInterface
     * @throws UnableToTranslateResponseException
     */
    public function translateResponse(\PHPAPILibrary\Core\Network\ResponseInterface $response): ResponseInterface
    {
        $data = $this->getDataTranslator($response)->translateData($response);

        return $this->buildResponse($data, $response);
    }

    /**
     * @param \PHPAPILibrary\Core\Network\ResponseInterface $response
     * @return DataTranslatorInterface
     * @throws UnableToTranslateResponseException
     */
    protected abstract function getDataTranslator(\PHPAPILibrary\Core\Network\ResponseInterface $response): DataTranslatorInterface;

    /**
     * @param DataInterface $data
     * @param \PHPAPILibrary\Core\Network\ResponseInterface $response
     * @return ResponseInterface
     * @throws UnableToTranslateResponseException
     */
    protected abstract function buildResponse(
        DataInterface $data, \PHPAPILibrary\Core\Network\ResponseInterface $response
    ): ResponseInterface;
}
