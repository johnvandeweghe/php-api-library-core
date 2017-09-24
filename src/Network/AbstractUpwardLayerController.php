<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Network\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Network\Exception\RequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;

/**
 * Class AbstractUpwardLayerController
 * @package PHPAPILibrary\Core\Network
 */
abstract class AbstractUpwardLayerController extends AbstractLayerController
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
        $identityRequest = $this->getUpwardRequestTranslator()->translateRequest($request);

        try {
            $identityResponse = $this->getUpwardLayer()->handleRequest($identityRequest);
        } catch(\PHPAPILibrary\Core\Identity\Exception\AccessDeniedException $exception) {
            $networkResponse = $this->getDownwardResponseTranslator()->translateResponse($exception->getResponse());
            throw new AccessDeniedException($networkResponse);
        } catch(\PHPAPILibrary\Core\Identity\Exception\RateLimitExceededException $exception) {
            $networkResponse = $this->getDownwardResponseTranslator()->translateResponse($exception->getResponse());
            throw new RateLimitExceededException($networkResponse);
        } catch(\PHPAPILibrary\Core\Identity\Exception\RequestException $exception) {
            $networkResponse = $this->getDownwardResponseTranslator()->translateResponse($exception->getResponse());
            throw new RequestException($networkResponse);
        } catch(\PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException $exception) {
            $networkResponse = $this->getDownwardResponseTranslator()->translateResponse($exception->getResponse());
            throw new UnableToProcessRequestException($networkResponse);
        }

        return $this->getDownwardResponseTranslator()->translateResponse($identityResponse);
    }

    /**
     * @return \PHPAPILibrary\Core\Identity\LayerControllerInterface
     */
    abstract public function getUpwardLayer(): \PHPAPILibrary\Core\Identity\LayerControllerInterface;

    /**
     * @return UpwardRequestTranslatorInterface
     */
    abstract public function getUpwardRequestTranslator(): UpwardRequestTranslatorInterface;

    /**
     * @return DownwardResponseTranslatorInterface
     */
    abstract public function getDownwardResponseTranslator(): DownwardResponseTranslatorInterface;
}
