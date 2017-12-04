<?php
namespace PHPAPILibrary\Core\Network\In;

use PHPAPILibrary\Core\Network\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Network\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Network\Exception\RequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateResponseException;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Core\Network\ResponseInterface;

/**
 * Class AbstractLayerController
 * @package PHPAPILibrary\Core\Network\In
 */
abstract class AbstractLayerController extends \PHPAPILibrary\Core\Network\AbstractLayerController
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
        try {
            $identityRequest = $this->getRequestTranslator()->translateRequest($request);

            $identityResponse = $this->getNextLayer()->handleRequest($identityRequest);
        } catch (\PHPAPILibrary\Core\Identity\Exception\AccessDeniedException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new AccessDeniedException($networkResponse);
        } catch (\PHPAPILibrary\Core\Identity\Exception\RateLimitExceededException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RateLimitExceededException($networkResponse);
        } catch (\PHPAPILibrary\Core\Identity\Exception\RequestException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RequestException($networkResponse);
        } catch (\PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new UnableToProcessRequestException($networkResponse);
        }

        return $this->getResponseTranslator()->translateResponse($identityResponse);
    }

    /**
     * @return \PHPAPILibrary\Core\Identity\LayerControllerInterface
     */
    abstract public function getNextLayer(): \PHPAPILibrary\Core\Identity\LayerControllerInterface;

    /**
     * @return RequestTranslatorInterface
     */
    abstract public function getRequestTranslator(): RequestTranslatorInterface;

    /**
     * @return ResponseTranslatorInterface
     */
    abstract public function getResponseTranslator(): ResponseTranslatorInterface;
}
