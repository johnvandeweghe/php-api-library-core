<?php
namespace PHPAPILibrary\Core\Data\Out;

use PHPAPILibrary\Core\Data\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Data\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Data\Exception\RequestException;
use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Data\RequestInterface;
use PHPAPILibrary\Core\Data\ResponseInterface;

/**
 * Class AbstractLayerController
 * @package PHPAPILibrary\Core\Data\Out
 */
abstract class AbstractLayerController extends \PHPAPILibrary\Core\Data\AbstractLayerController
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
            $networkRequest = $this->getRequestTranslator()->translateRequest($request);

            $networkResponse = $this->getNextLayer()->handleRequest($networkRequest);
        } catch (\PHPAPILibrary\Core\Network\Exception\AccessDeniedException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new AccessDeniedException($networkResponse);
        } catch (\PHPAPILibrary\Core\Network\Exception\RateLimitExceededException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RateLimitExceededException($networkResponse);
        } catch (\PHPAPILibrary\Core\Network\Exception\RequestException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RequestException($networkResponse);
        } catch (\PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new UnableToProcessRequestException($networkResponse);
        }

        return $this->getResponseTranslator()->translateResponse($networkResponse);
    }

    /**
     * @return \PHPAPILibrary\Core\Network\LayerControllerInterface
     */
    abstract protected function getNextLayer(): \PHPAPILibrary\Core\Network\LayerControllerInterface;

    /**
     * @return RequestTranslatorInterface
     */
    abstract protected function getRequestTranslator(): RequestTranslatorInterface;

    /**
     * @return ResponseTranslatorInterface
     */
    abstract protected function getResponseTranslator(): ResponseTranslatorInterface;
}
