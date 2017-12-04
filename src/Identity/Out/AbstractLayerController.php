<?php
namespace PHPAPILibrary\Core\Identity\Out;

use PHPAPILibrary\Core\Identity\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Identity\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Identity\Exception\RequestException;
use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Identity\RequestInterface;
use PHPAPILibrary\Core\Identity\ResponseInterface;

/**
 * Class AbstractLayerController
 * @package PHPAPILibrary\Core\Identity\Out
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
        try {
            $networkRequest = $this->getRequestTranslator()->translateRequest($request);

            $networkResponse = $this->getNextLayer()->handleRequest($networkRequest);
        } catch(\PHPAPILibrary\Core\Network\Exception\AccessDeniedException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new AccessDeniedException($networkResponse);
        } catch(\PHPAPILibrary\Core\Network\Exception\RateLimitExceededException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RateLimitExceededException($networkResponse);
        } catch(\PHPAPILibrary\Core\Network\Exception\RequestException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RequestException($networkResponse);
        } catch(\PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException $exception) {
            $networkResponse = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new UnableToProcessRequestException($networkResponse);
        }

        return $this->getResponseTranslator()->translateResponse($networkResponse);
    }

    /**
     * @return \PHPAPILibrary\Core\Network\LayerControllerInterface
     */
    abstract public function getNextLayer(): \PHPAPILibrary\Core\Network\LayerControllerInterface;

    /**
     * @return RequestTranslatorInterface
     */
    abstract public function getRequestTranslator(): RequestTranslatorInterface;

    /**
     * @return ResponseTranslatorInterface
     */
    abstract public function getResponseTranslator(): ResponseTranslatorInterface;
}
