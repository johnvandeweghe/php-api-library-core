<?php
namespace PHPAPILibrary\Core\Identity\In;

use PHPAPILibrary\Core\Identity\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Identity\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Identity\Exception\RequestException;
use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Identity\RequestInterface;
use PHPAPILibrary\Core\Identity\ResponseInterface;

/**
 * Class AbstractLayerController
 * @package PHPAPILibrary\Core\Identity\In
 */
abstract class AbstractLayerController extends \PHPAPILibrary\Core\Identity\AbstractLayerController
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws AccessDeniedException
     * @throws RateLimitExceededException
     * @throws UnableToProcessRequestException
     */
    protected function getResponse(RequestInterface $request): ResponseInterface
    {
        $dataRequest = $this->getRequestTranslator()->translateRequest($request);

        try {
            $dataResponse = $this->getNextLayer()->handleRequest($dataRequest);
        } catch(\PHPAPILibrary\Core\Data\Exception\AccessDeniedException $exception) {
            $dataResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new AccessDeniedException($dataResponse);
        } catch(\PHPAPILibrary\Core\Data\Exception\RateLimitExceededException $exception) {
            $dataResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RateLimitExceededException($dataResponse);
        } catch(\PHPAPILibrary\Core\Data\Exception\RequestException $exception) {
            $dataResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RequestException($dataResponse);
        } catch(\PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException $exception) {
            $dataResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new UnableToProcessRequestException($dataResponse);
        }

        return $this->getResponseTranslator()->translateResponse($dataResponse);
    }

    /**
     * @return \PHPAPILibrary\Core\Data\LayerControllerInterface
     */
    abstract public function getNextLayer(): \PHPAPILibrary\Core\Data\LayerControllerInterface;

    /**
     * @return RequestTranslatorInterface
     */
    abstract public function getRequestTranslator(): RequestTranslatorInterface;

    /**
     * @return ResponseTranslatorInterface
     */
    abstract public function getResponseTranslator(): ResponseTranslatorInterface;
}
