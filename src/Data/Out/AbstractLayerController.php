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
        $identityRequest = $this->getRequestTranslator()->translateRequest($request);

        try {
            $identityRequest = $this->getNextLayer()->handleRequest($identityRequest);
        } catch(\PHPAPILibrary\Core\Identity\Exception\AccessDeniedException $exception) {
            $identityRequest = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new AccessDeniedException($identityRequest);
        } catch(\PHPAPILibrary\Core\Identity\Exception\RateLimitExceededException $exception) {
            $identityRequest = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RateLimitExceededException($identityRequest);
        } catch(\PHPAPILibrary\Core\Identity\Exception\RequestException $exception) {
            $identityRequest = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new RequestException($identityRequest);
        } catch(\PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException $exception) {
            $identityRequest = $this->getResponseTranslator()->translateResponse($exception->getResponse());
            throw new UnableToProcessRequestException($identityRequest);
        }

        return $this->getResponseTranslator()->translateResponse($identityRequest);
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
