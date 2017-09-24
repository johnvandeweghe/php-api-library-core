<?php
namespace PHPAPILibrary\Core\Network;

/**
 * Class AbstractUpwardLayerController
 * @package PHPAPILibrary\Core\Network
 */
abstract class AbstractUpwardLayerController extends AbstractLayerController
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    protected function getResponse(RequestInterface $request): ResponseInterface
    {
        $identityRequest = $this->getServerRequestTranslator()->translateRequest($request);

        $identityResponse = $this->getIdentityLayer()->handleRequest($identityRequest);

        return $this->getServerResponseTranslator()->translateResponse($identityResponse);
    }

    /**
     * @return \PHPAPILibrary\Core\Identity\LayerControllerInterface
     */
    abstract public function getIdentityLayer(): \PHPAPILibrary\Core\Identity\LayerControllerInterface;

    /**
     * @return ToIdentityRequestTranslatorInterface
     */
    abstract public function getServerRequestTranslator(): ToIdentityRequestTranslatorInterface;

    /**
     * @return FromIdentityResponseTranslatorInterface
     */
    abstract public function getServerResponseTranslator(): FromIdentityResponseTranslatorInterface;
}
