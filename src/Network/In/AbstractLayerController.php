<?php
namespace PHPAPILibrary\Core\Network\In;

use PHPAPILibrary\Core\Network\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Network\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Network\Exception\RequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
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
        } catch (\PHPAPILibrary\Core\Data\Exception\AccessDeniedException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new AccessDeniedException($networkResponse);
        } catch (\PHPAPILibrary\Core\Data\Exception\RateLimitExceededException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RateLimitExceededException($networkResponse);
        } catch (\PHPAPILibrary\Core\Data\Exception\RequestException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RequestException($networkResponse);
        } catch (\PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new UnableToProcessRequestException($networkResponse);
        }

        return $this->getResponseTranslator()->translateResponse($identityResponse);
    }

    /**
     * @return \PHPAPILibrary\Core\Data\LayerControllerInterface
     */
    abstract protected function getNextLayer(): \PHPAPILibrary\Core\Data\LayerControllerInterface;

    /**
     * @return RequestTranslatorInterface
     */
    abstract protected function getRequestTranslator(): RequestTranslatorInterface;

    /**
     * @return ResponseTranslatorInterface
     */
    abstract protected function getResponseTranslator(): ResponseTranslatorInterface;
}
