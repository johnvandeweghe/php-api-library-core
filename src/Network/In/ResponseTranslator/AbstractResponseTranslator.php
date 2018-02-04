<?php
namespace PHPAPILibrary\Core\Network\In\ResponseTranslator;

use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateResponseException;
use PHPAPILibrary\Core\Network\In\ResponseTranslatorInterface;
use PHPAPILibrary\Core\Network\Response\Response;
use PHPAPILibrary\Core\Network\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class AbstractRequestTranslator
 * @package PHPAPILibrary\Core\Network\In\ResponseTranslator
 */
abstract class AbstractResponseTranslator implements ResponseTranslatorInterface
{
    /**
     * @param \PHPAPILibrary\Core\Identity\ResponseInterface $response
     * @return ResponseInterface
     * @throws UnableToTranslateResponseException
     */
    public function translateResponse(\PHPAPILibrary\Core\Identity\ResponseInterface $response): ResponseInterface
    {
        $data = $this->getDataTranslator()->translateData($response);

        return $this->buildResponse($data, $response);
    }

    /**
     * @return DataTranslatorInterface
     * @throws UnableToTranslateResponseException
     */
    protected abstract function getDataTranslator(): DataTranslatorInterface;

    /**
     * @param StreamInterface $data
     * @param \PHPAPILibrary\Core\Identity\ResponseInterface $response
     * @return Response
     * @throws UnableToTranslateResponseException
     */
    protected abstract function buildResponse(
        StreamInterface $data, \PHPAPILibrary\Core\Identity\ResponseInterface $response
    ): Response;
}
